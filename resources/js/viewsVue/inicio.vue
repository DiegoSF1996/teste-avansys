<template>
  <div class="col-md-12">
    <h5 class="card-title">Operadora</h5>
    <hr />

    <div class="form-row">
      <div class="col-md-7 mb-3">
        <label for="ls_ope_codigo">Listar Operadora</label>
        <select
          class="custom-select"
          id="ls_ope_codigo"
          name="op_codigo"
          v-model="listar.ope_codigo"
        >
          <option selected>--Selecione--</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>

      <div class="col-md-5 mb-3">
        <label for="ls_ope_status">Situação</label>
        <select
          class="custom-select"
          id="ls_ope_status"
          name="ope_status"
          v-model="listar.ope_status"
        >
          <option selected>--Selecione--</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
    </div>
    <div class="mb-3">
      <a @click.prevent="listarOperadoras" href="" class="btn btn-primary"
        ><span class="fa fa-plus"></span
      ></a>
    </div>
    <div class="mb-3">
      <a @click.prevent="pop" href="" class="btn btn-primary"
        ><span class="fa fa-plus"></span>teste</a
      >
    </div>
    <div class="mb-3">
      <div class="btn-group" role="group" aria-label="Basic example">
        <div class="mr-2">
          <button
            type="button"
            @click="marcarTodos()"
            class="btn btn-secondary"
          >
            Marcar Todos
          </button>
        </div>
        <div class="mr-2">
          <button type="button" @click="excluir()" class="btn btn-secondary">
            Excluir
          </button>
        </div>
        <div class="mr-2">
          <button
            type="button"
            @click="habilitarDesabilitar()"
            class="btn btn-secondary"
          >
            Habilitar e Desabilitar
          </button>
        </div>
      </div>
    </div>
    <div class="mb-3">
      <table class="table">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Operadora</th>
            <th scope="col">Descrição</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <button
                @click="salvar(operadoraSalvar)"
                type="button"
                class="btn btn-success"
              >
                <span class="fa fa-check fa-lg"></span>
              </button>
              <button @click="limpar()" type="button" class="btn btn-danger">
                <span class="fa fa-times-circle fa-lg"></span>
              </button>
            </td>
            <td>
              <input
                type="text"
                v-model="operadoraSalvar.ope_descricao"
                name="ope_descricao"
              />
            </td>
            <td>
              <input
                type="text"
                v-model="operadoraSalvar.ope_observacao"
                name="ope_observacao"
              />
            </td>
          </tr>
          <tr v-for="operadora in operadoras" :key="operadora.ope_codigo">
            <th scope="row">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  v-model="operadora.ope_check"
                  v-bind:id="'c' + operadora.ope_check"
                />
                <label
                  class="form-check-label"
                  v-bind:for="'c' + operadora.ope_codigo"
                >
                  Default checkbox
                </label>
              </div>

              <div class="custom-control custom-switch">
                <input
                  type="checkbox"
                  name="ope_status"
                  v-model="operadora.ope_status"
                  class="custom-control-input"
                  v-bind:id="'s' + operadora.ope_codigo"
                  @change="salvar(operadora)"
                />
                <label
                  class="custom-control-label"
                  v-bind:for="'s' + operadora.ope_codigo"
                ></label>
              </div>
            </th>
            <td>
              <input
                type="text"
                name="ope_descricao"
                v-model="operadora.ope_descricao"
                @change="salvar(operadora)"
              />
            </td>
            <td>
              <input
                type="text"
                name="ope_descricao"
                v-model="operadora.ope_observacao"
                @change="salvar(operadora)"
              />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      indice: 0,
      operadoraSalvar: {},
      checkbox: [],
      operadoras: [],
      listar: {
        ope_codigo: "",
        ope_status: "",
      },
      erros: [],
    };
  },
  mounted() {
    this.listarOperadoras();
  },
  methods: {
    salvar(operadora) {
      if (operadora.ope_status == undefined) {
        operadora.ope_status = true;
      }
      console.log(operadora);
      axios
        .post("/api/salvar", operadora)
        .then((res) => {
          console.log(res.data);
        })
        .catch((error) => {
          //console.log(error.response.data);
          this.erros = error.response.data.errors;

        });
      this.operadoraSalvar = {};
      this.listarOperadoras();
    },
    marcarTodos() {
      this.operadoras.forEach((op, indice) => {
        Vue.set(this.operadoras[indice], "ope_check", true);
      });
    },
    excluir() {
      axios
        .post("/api/excluirOperadoras", this.operadoras)
        .then((res) => {
          //console.log(res.data);
        })
        .catch((error) => {
          //console.log(error.response.data);

          this.erros = error.response.data.errors;
        });
      this.listarOperadoras();
    },
    limpar() {
      this.operadoraSalvar = {};
    },
    listarOperadoras() {
      axios
        .post("/api/listarOperadoras")
        .then((res) => {
          this.operadoras = res.data;
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
    pop() {
      this.operadoras.push({
        ope_codigo: this.indice++,
        ope_descricao: "CLARO",
        ope_observacao: "ruim",
      });
    },
  },
};
</script>