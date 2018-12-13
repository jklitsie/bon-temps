<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" v-if="!trigger">
                    <div class="card-header">
                        <h1 class="">Tafel overzicht</h1>
                        <button @click="toggleCreateTafel" class="btn btn-primary" :disabled="create">Nieuwe tafel</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-fixed">
                            <thead>
                                <td>Tafelnummer</td>
                                <td>Capaciteit</td>
                                <td>Acties</td>
                            </thead>
                            <tbody >
                                <tr v-for="(tafel, key) in tafels" :class="{'table-primary': tafel.edit}">
                                    <td>
                                        <span v-if="!tafel.edit">
                                            {{tafel.tafel_nummer}}
                                        </span>
                                        <input v-if="tafel.edit" type="number" class="form-control" v-model="tafel.copy.tafel_nummer" >
                                    </td>
                                    <td>
                                        <span v-if="!tafel.edit">
                                            {{tafel.stoelen}}
                                        </span>
                                        <input v-if="tafel.edit" type="number" class="form-control" v-model="tafel.copy.stoelen" >
                                    </td>
                                    <td colspan="1">
                                        <button v-if="!tafel.edit" @click="toggleEdit(key)" class="btn btn-primary">Bewerk</button>
                                        <button v-if="!tafel.edit" v-on:click="deleteTafel(tafel)" class="btn btn-danger">Verwijder</button>
                                        <button v-if="tafel.edit" @click="updateTafel(key)" class="btn btn-primary">Wijzig</button>
                                        <button v-if="tafel.edit" @click="toggleEdit(key)" class="btn btn-danger">Annuleer</button>
                                    </td>
                                </tr>
                                <tr v-if="create">
                                    <td>
                                        <input type="number" class="form-control" autofocus v-model="newTafel.tafel_nummer" >
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" v-model="newTafel.stoelen" >
                                    </td>
                                    <td>
                                        <button @click="createTafel" class="btn btn-success">Maak aan</button>
                                        <button @click="cancelCreateTafel" class="btn btn-link">Annuleer</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
      data() {
        return {
          tafels: [],
          log: '',
          trigger: false,
          isEdit: false,
          create: false,
          newTafel: {},
        }
      },
      methods: {
        toggleEdit(key) {
          this.tafels[key].edit = !this.tafels[key].edit;
          if(this.tafels[key].edit ) {
            this.tafels[key].copy = Object.assign({},this.tafels[key]);
          } else {
            this.tafels[key].copy = {}
          }
        },
        gettafels(){
          axios.get('/api/tafels').then( (response) => {
            response.data.forEach( (data) => {
                data.edit = false;
                data.copy = {};
            });
            this.tafels = response.data;
          });
        },
        viewEditTafel(tafel){
            this.trigger = true;
            this.isEdit = true;
            this.tafel = tafel;
        },
        toggleCreateTafel(){
          this.create = true;
        },
        cancelCreateTafel() {
          this.create = false;
          this.newTafel = [];
        },
        createTafel() {
          axios.post('/api/tafels',this.newTafel).then( (response) => {
            if(response){
              this.gettafels();
              this.create = false;
              this.newTafel = {};
            }else{
              alert('er gaat iets fout');
            }
          });
        },
        updateTafel(key){
          axios.post(`/api/tafel/${this.tafels[key].id}`,this.tafels[key].copy).then( (response) => {
            if(response){
              this.gettafels();
            }else{
              alert('er gaat iets fout');
            }
          });
        },
        deleteTafel(tafel) {
          axios.post(`/api/tafel/${tafel.id}/delete`, tafel).then( (response) => {
            //TODO flash succes message
            console.log(response.data);
            this.gettafels()
          });
        }
      },
      mounted() {
        this.gettafels();

      },
    }
</script>
