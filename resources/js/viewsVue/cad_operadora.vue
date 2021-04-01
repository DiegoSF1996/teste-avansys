<template>
  <div class="col-md-12">
    <h5 class="card-title">Cadastro Operadora</h5>

    <hr />
    <div class="mb-3">
      <div class="btn-group" role="group" aria-label="Basic example">
        <div class="mr-2">
          <button
            type="button"
            @click="marcarTodos()"
            class="btn btn-secondary btn-sm"
          >
            <span class="fa fa-check-square"></span>

            Marcar Todos
          </button>
        </div>

        <div class="mr-2">
          <button
            type="button"
            @click="excluir()"
            class="btn btn-secondary btn-sm"
          >
            <span class="fa fa-trash"></span>

            Excluir
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
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              <button
                @click="salvar(operadoraSalvar, true)"
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
                </label>
              </div>
            </th>

            <td>
              <input
                type="text"
                name="ope_descricao"
                v-model="operadora.ope_descricao"
                @change="salvar(operadora, true)"
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
      operadoraSalvar: {},
      operadoras: [],
      erros: [],
    };
  },
  mounted() {
    this.listarOperadoras();
  },
  methods: {
    marcarTodos() {
      this.operadoras.forEach((op, indice) => {
        Vue.set(this.operadoras[indice], "ope_check", true);
      });
    },
    salvar(operadora, atualiza = false) {
      axios
        .post("/api/salvar", operadora)
        .then((res) => {
          this.operadoraSalvar = {};
          this.listarOperadoras();
        })
        .catch((error) => {
          //console.log(error.response.data);
          this.erros = error.response.data.errors;
        });
    },

    excluir() {
      axios
        .post("/api/excluirOperadoras", this.operadoras)
        .then((res) => {
          //console.log(res.data);
        })
        .catch((error) => {
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
  },
};
</script>