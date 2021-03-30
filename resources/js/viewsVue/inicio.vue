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
      <a @click.prevent="listarOperadoras" href="" class="btn btn-primary"><span class="fa fa-plus"></span></a>
    </div>
    <div class="mb-3">
      <div class="btn-group" role="group" aria-label="Basic example">
        <div class="mr-2">
          <button type="button" class="btn btn-secondary">Marcar Todos</button>
        </div>
        <div class="mr-2">
          <button type="button" class="btn btn-secondary">Excluir</button>
        </div>
        <div class="mr-2">
          <button type="button" class="btn btn-secondary">
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
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
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
      operadora: {
        ope_codigo: "",
        ope_descricao: "",
        ope_status: "",
        ope_observacao: "",
      },
      listar: {
        ope_codigo: "",
        ope_status: "",
      },
      erros: [],
    };
  },methods:{
    listarOperadoras(){
      axios.post('/api/listarOperadoras',this.listar).then(()=>{
        console.log('listou');
      }).catch((error)=>{
        this.erros = error.response.data.errors;
      })
    }
  }
};
</script>