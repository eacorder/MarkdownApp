<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-success ">
                    <div class="card-header  bg-success text-white">
                        <div class="row">
                            <div class="col-md-8 ">Administrador de Documentos</div>
                            <div class="col-md-4">
                                <div class="d-grid  d-md-flex justify-content-md-end">
                                    <a type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>                                          
                    </div>                
                    <div class="card-body text-success" >
                        <div class="row py-3"> 
                            <div class="col-md-8"> 
                                <input type="text" v-model="filter" class="form-control"  placeholder="Search" >
                            </div>
                         
                            <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary " type="button" @click="openModal()" >                              
                                    Add Document 
                                </button>
                            </div>   
                        </div>
                        <div class="row">                    
                            <doc-form v-on:reloadlist="getList()"/>
                            <doc-form-edit v-on:reloadlist="getList()"/>
                            <div class="py-4">
                                <doc-list :docs="docs" :filter="filter" v-on:reloadlist="getList()"/>
                            </div>                                      
                        </div>               
                    </div>  
                </div>                           
            </div>        
        </div>
    </div>
</template>

<script>     
import DocForm from './components/DocForm';
import DocFormEdit from './components/DocFormEdit.vue';
import DocList from './components/DocList';
    export default{
        components: { DocForm, DocList,DocFormEdit },     
        data: function(){
            return {
                docs: [],
                filter:'',
            }
        },
        methods:{
            getList (){
                axios.get('api/documents')
                .then( response => {
                    this.docs = response.data 
                })
                .catch( error => {
                    console.log(error);
                })
            },
            openModal(){   
                $('#DocForm').modal('show'); 
            }
        },
        created(){
            this.getList();
        }
        
    }
</script>