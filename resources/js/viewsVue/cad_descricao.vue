<template>
  <div class="col-md-12">
    <h5 class="card-title">Cadastro Descrição</h5>

    <hr />

    <div class="form-row">
      <div class="col-md-7 mb-3">
        <label for="ls_ope_codigo">Listar Operadora</label>

        <select
          class="custom-select"
          id="ls_ope_codigo"
          name="ls_ope_codigo"
          v-model="filtros.ope_codigo"
          @change="lsDescricaoPorOperadora()"
        >
          <option selected value="">--Selecione--</option>
          <option
            v-for="operadora in operadoras"
            :key="operadora.ope_codigo"
            :value="operadora.ope_codigo"
          >
            {{ operadora.ope_descricao }}
          </option>
        </select>
      </div>

      <div class="col-md-5 mb-3">
        <label for="ls_desc_status">Situação</label>

        <select
          class="custom-select"
          id="ls_desc_status"
          name="desc_status"
          v-model="filtros.desc_status"
          @change="lsDescricaoPorOperadora()"
        >
          <option selected value="">Todos</option>

          <option value="1">Ativado</option>

          <option value="0">Desativado</option>
        </select>
      </div>
    </div>

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

        <div class="mr-2">
          <button
            type="button"
            @click="habilitarDesabilitar()"
            class="btn btn-secondary btn-sm"
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
                @click="salvar(descricaoSalvar, true)"
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
                disabled
                type="hidden"
                v-model="descricaoSalvar.ope_codigo"
                name="op_codigo"
              />
              <input
                disabled
                type="text"
                v-model="descricaoSalvar.ope_descricao"
                name="ope_descricao"
              />
            </td>

            <td>
              <input
                type="text"
                v-model="descricaoSalvar.desc_descricao"
                name="desc_descricao"
              />
            </td>
          </tr>

          <tr v-for="descricao in descricoes" :key="descricao.desc_codigo">
            <th scope="row">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  v-model="descricao.desc_check"
                  v-bind:id="'c' + descricao.desc_check"
                />

                <label
                  class="form-check-label"
                  v-bind:for="'c' + descricao.desc_codigo"
                >
                </label>
              </div>

              <div class="custom-control custom-switch">
                <input
                  type="checkbox"
                  name="desc_status"
                  v-model="descricao.desc_status"
                  class="custom-control-input"
                  v-bind:id="'s' + descricao.desc_codigo"
                  @change="salvar(descricao, true)"
                />

                <label
                  class="custom-control-label"
                  v-bind:for="'s' + descricao.desc_codigo"
                ></label>
              </div>
            </th>

            <td>
              <input
                type="text"
                name="desc_codigo"
                disabled
                v-model="descricao.ope_descricao"
                @change="salvar(descricao, true)"
              />
            </td>

            <td>
              <input
                type="text"
                name="ope_descricao"
                v-model="descricao.desc_descricao"
                @change="salvar(descricao, true)"
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
      filtros: {},
      descricaoSalvar: {},
      operadoras: [],
      descricoes: [],
      erros: [],
    };
  },
  mounted() {
    this.lsOperadoras();
    this.lsDescricaoPorOperadora();
  },
  methods: {
    salvar(descricao, atualiza = false) {
      if (descricao.desc_status == undefined) {
        descricao.desc_status = true;
      }
      axios
        .post("/api/salvarDescricao", descricao)
        .then((res) => {
          if (atualiza == true) {
            this.descricaoSalvar.desc_descricao = null;
            this.descricoes = {};
            this.lsDescricaoPorOperadora();
          }
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
    marcarTodos() {
      this.descricoes.forEach((op, indice) => {
        Vue.set(this.descricoes[indice], "desc_check", true);
      });
    },
    habilitarDesabilitar() {
      this.descricoes.forEach((op, indice) => {
        if (this.descricoes[indice].desc_check == true) {
          if (this.descricoes[indice].desc_status == true) {
            Vue.set(this.descricoes[indice], "desc_status", false);
          } else {
            Vue.set(this.descricoes[indice], "desc_status", true);
          }
          this.salvar(this.descricoes[indice], false);
        }
      });
      this.lsDescricaoPorOperadora();
    },
    excluir() {
      axios
        .post("/api/excluirDescricoes", this.descricoes)
        .then((res) => {})
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
      this.lsDescricaoPorOperadora();
    },
    limpar() {
      this.descricaoSalvar = {};
    },

    lsOperadoras() {
      axios
        .get("/api/lsOperadoras")
        .then((res) => {
          this.operadoras = res.data;
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
    lsDescricaoPorOperadora() {
      var keyy = Object.keys(this.operadoras).find(
        (key) => this.operadoras[key].ope_codigo == this.filtros.ope_codigo
      );
      if (keyy != undefined) {
        this.descricaoSalvar.ope_descricao = this.operadoras[
          keyy
        ].ope_descricao;
        this.descricaoSalvar.ope_codigo = this.filtros.ope_codigo;
      } else{
          this.descricaoSalvar.ope_codigo = null;
          this.descricaoSalvar.ope_descricao = null;
      }
      axios
        .post("/api/lsDescricaoPorOperadora", this.filtros)
        .then((res) => {
          this.descricoes = res.data;
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
  },
};
</script>