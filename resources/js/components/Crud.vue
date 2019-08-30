<template>
    <div >

        <v-client-table :data="tableData" :columns="columns" :options="options">
          <a style="margin:0px 40px;" slot="beforeLimit" @click="create()" class="btn btn-primary btn-big btn-add"><i class="glyphicon glyphicon-plus"></i></a>
          <a style="margin:0px 0px;" slot="beforeLimit" @click="upload()" class="btn btn-primary btn-big btn-add"><i class="glyphicon glyphicon-cloud-upload"></i></a>
                    <download-csv
                        slot="beforeLimit"
                        style="margin:0px 15px;"
                        class="btn btn-primary btn-big btn-add"

                        :data   = "tableDataCSV">
                        <i class="glyphicon glyphicon-cloud-download"></i>
                    </download-csv>
          <template slot="actions" slot-scope="{ row }">
            <div style="width:67px">
                <div class='buttons'>
                    <button style="padding:0px 10px;font-size: 10px" class="btn btn-sm" @click="edit(row.id)"><i class="glyphicon glyphicon-pencil"></i></button>
                    <button style="padding:0px 10px;font-size: 10px" class="btn btn-sm" @click="destroy(row.id)"><i class="glyphicon glyphicon-trash"></i></button>
                </div>
            </div>
          </template>

        </v-client-table>

                    <div class="modal fade" tabindex="-1" role="dialog" id="form_model_crud">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" v-if="criando">Create</h4>
                                    <h4 class="modal-title" v-else>Edit</h4>
                                </div>

                                <div class="modal-body">
                                    <vue-form-generator :schema="schemagenerator" :model="model" :options="formOptions"></vue-form-generator>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" @click="store" v-if="criando" class="btn btn-primary">Save</button>
                                        <button type="button" @click="update" v-else class="btn btn-primary">Update</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                      <div class="modal fade" tabindex="-1" role="dialog" id="form_model_upload">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" >Upload CSV to Import</h4>
                                </div>

                                <div class="modal-body">
                                  <file-pond
                                    label-idle="Drop files here..."
                                    allow-multiple="true"
                                    accepted-file-types="text/csv"
                                    @processfile="index()"
                                    :server="server"
                                    />

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" tabindex="-1" role="dialog" id="form_model_profile">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit Profile</h4>
                                </div>

                                <div class="modal-body">
                                    <vue-form-generator :schema="schemaprofile" :model="model" :options="formOptions"></vue-form-generator>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" @click="update" class="btn btn-primary">Update</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

    </div>
</template>

<script>
  import JsonCSV from 'vue-json-csv'
  Vue.component('downloadCsv', JsonCSV)

  import datePicker from 'vue-bootstrap-datetimepicker';
  import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

    import {ServerTable, ClientTable, Event} from 'vue-tables-2';
    Vue.use(ClientTable );

    import VueFormGenerator from 'vue-form-generator';
    Vue.use(VueFormGenerator);
    //import "vue-form-generator/dist/vfg-core.css";
    //import 'vue-form-generator/dist/vfg.css'

    import vueFilePond from 'vue-filepond';
    import 'filepond/dist/filepond.min.css';
    import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
    const FilePond = vueFilePond(FilePondPluginFileValidateType)

    export default {
        // Assets
        components: {FilePond},

        // Composition
        mixins: [],

        extends: {},

        // Data
        data() {
            return {
                server: {
                  url:this.url() + '/api/events/import',
                  headers:{
                    'X-XSRF-TOKEN':this.getCookie('XSRF-TOKEN'),
                  }
                }
                ,
                columns: [],
                tableData: [],
                tableDataCSV: [],
                errors: [],
                showModal: false,
                model: {},
                criando:true,
                options: {
                    headings: {
                        'event.title': "Event",
                        'user.name': "Owner",
                        'actions' : "Ações"
                    },
                    theme: "bootstrap3",
                    //template: "default",
                    sortIcon: {
                        base : 'fa',
                        is: 'fa-sort',
                        up: 'fa-sort-asc',
                        down: 'fa-sort-desc'
                    },
                    //filterable:["name","email"]
                    templates:{
                      confirm:   function(h, row) {if(row.confirm!== null)      return row.confirm ? 'Sim': 'Não'},
                    },
                    //rowClassCallback: function (row) {
                      //return 'test'
                    //},
                    perPageValues:[5,10,25,50,100],
                },

                tablefields: require('../../../database/migrations/schema_server/'+this.fonte.charAt(0).toUpperCase() + this.fonte.slice(1)+'.json'),
                schemagenerator: require('./schema_form/'+this.fonte.charAt(0).toUpperCase() + this.fonte.slice(1)+'.json'),
                schemaprofile:    require('./schema_form/Users.json'),
                formOptions:{
                  //validateAfterLoad: true,
                  //validateAfterChanged: true,
                  //validateAsync: true
                },
            }
        },

        props: ['caminho','owner','fonte'],

        //propsData: {},

        computed: {},

        methods: {
            pluck(data, key) {
              var array = [];
              for(var i in data){
                  if(data[i].hasOwnProperty(key))array.push(data[i][key]);
              }
              return array;
            },

            url(){
              var pathArray = window.location.pathname.split( '/' );
              var saida;

              saida = window.location.protocol + "//" + window.location.host ;
              if (pathArray.length > 2) 
                for (var i in pathArray)
                {
                  if (i==0)continue
                  if (i==pathArray.length-1)break
                  saida += "/" + pathArray[i] ;
                }
              return saida;
            },
             
            getCookie(name)
              {
                var re = new RegExp(name + "=([^;]+)");
                var value = re.exec(document.cookie);
                return (value != null) ? unescape(value[1]) : null;
              },

            events(index){
                axios
                .get(this.url()+'/api/my_events')
                .then(response => {
                    response.data.forEach(element => {
                      Object.defineProperty(element, 'name',
                            Object.getOwnPropertyDescriptor(element, 'title'))
                    });
                    Vue.set(this.schemagenerator.fields[index], 'values', response.data );
                })
                .catch(error => {
                  console.log(error)
                });
            },

            index(){
                axios
                .get(this.url()+'/api/'+this.caminho)
                .then(response => {
                    console.log(JSON.stringify(response.data))
                    this.tableData = Object.assign([], response.data)
                    this.tableDataCSV = Object.assign([], this.tableData)

                    this.tableDataCSV.forEach(element => {
                      Vue.delete(element, 'user');
                      Vue.delete(element, 'event');
                      Vue.delete(element, 'deleted_at');
                    });
                })
                .catch(error => {
                  console.log(error)
                });
            },

            create()
            {
                this.criando=true;
                $("#form_model_crud").modal("show");
                this.model={};
                this.model.owner=this.owner;
                this.errors = [];
            },

            store() {
              console.log(JSON.stringify(this.model))

              axios
              .post(this.url()+`/api/`+this.fonte, this.model)
              .then(response => {
                $("#form_model_crud").modal("hide");
                this.index() // Atualizar dados com o servidor
                console.log(JSON.stringify(response.data))
                })
              .catch(error => {
                       console.log(JSON.stringify(error.response.data));
                       //console.log(JSON.stringify(error.response.data.message));
                       //this.errors = [];
              })
            },

            edit (data)
            {
              this.criando=false;
              const item = this.tableData.filter((obj)=>{ return obj.id === data; }).pop();
                      this._beforeEditingCache = Object.assign({}, item);
                      this.errors = [];
                      this.model= this._beforeEditingCache;
                      $("#form_model_crud").modal("show");
            },

            update()
            {
                console.log(JSON.stringify(this.model))

                var index=this.tableData.findIndex(x => x.id === this.model.id)
                this.tableData[index] = Object.assign({}, this.model) // Não fica visivel
                this.tableData = Object.assign([], this.tableData) // Só para atualizar a tabela
                console.log(JSON.stringify(this.model))

                axios.patch(this.url()+'/api/'+this.fonte+'/' + this.model.id, this.model)
                    .then(response => {
                        $("#form_model_crud").modal("hide");
                        this.index() // Atualizar dados com o servidor
                        console.log(JSON.stringify(response.data))
                   })
                   .catch(error => {
                     // !!! Mudar o botão de Atualizar
                      console.log('Erro:'+this.url()+'/api/'+this.fonte+'/' + this.model.id);
                      console.log(error);
                      this.index()
                   });
            },

            upload()
            {
              $("#form_model_upload").modal("show");
            },

            destroy(data)
            {
              
                let conf = confirm("Realmente deseja apagar?");
                if (conf === true) {
                    var index=this.tableData.findIndex(x => x.id === data)
                    this.tableData.splice(index,1);
                  
                    axios.delete(this.url()+'/api/'+this.fonte+'/' + data)
                        .then(response => {
                            this.index() // Atualizar dados com o servidor
                            //this.flash(' Apagado ', 'success', { timeout: 4000, });
                        })
                        .catch(error => {
                            console.log(error);
                        });
               }
            },

        },

        watch: {},

        // Lifecycle Hooks
        beforeCreate() {},

        created() {
            this.index();
            this.columns=this.pluck(this.tablefields,'name')

            var index=this.columns.findIndex(x => x === 'eventid')
                    if(index!=-1)this.columns[index]='event.title';
            
            var index=this.columns.findIndex(x => x === 'owner')
                    if(index!=-1){if(this.caminho != 'my_events')this.columns[index]='user.name'; else this.columns.splice(index,1);}

            this.options.sortable=Object.assign([], this.columns)
            

            if((this.caminho == 'my_events')||(this.caminho == 'invitations'))this.columns.push('actions')
            if((screen.height<=768)||(screen.width<=768)) this.options.perPage=5;

            var index=this.schemagenerator.fields.findIndex(x => (x.label === 'Event')&&(x.type === 'select') )
              if(index!=-1) this.events(index)
        },

        beforeMount() {},

        mounted() {
            document.querySelectorAll("ul.nav.navbar-nav li").forEach(function(item) {
              if(item.children[0].innerText==' Profile')
              item.onclick = function(e) {
                 $("#form_model_profile").modal("show");
              }
            });
        },

        beforeUpdate() {},

        updated() {},

        activated() {},

        deactivated() {},

        beforeDestroy() {},

        destroyed() {}
    }
</script>

<style>

    .glyphicon {
        font-size: 16px;
    }

    .VueTables__limit-field {
        display: inline;
    }

    .VuePagination__pagination {
      margin:4px 30px;
    }

    .VuePagination__count{
      overflow:auto;
      width:auto;
      display: inline-block;
      float:unset;
    }

    .buttons{
        white-space: nowrap;
    }

    .VueTables tr:hover td{
      background-color:#FDF0F8;
    }

    
    tr div.buttons {
      display: none;
    }

    tr:hover div.buttons {
      display: block;
    }

    .filepond--file {
      font-size:15px !important;
    }

    .content-header{
      text-align: center;
    }

</style>
