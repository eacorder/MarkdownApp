<template>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="DocFormEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Document</h5>
                    <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form  v-on:submit.prevent="updateDoc">     
                <div class="modal-body">
                             
                        <div class="mb-3">
                            <label for="Title" class="form-label">Title</label>
                            <input type="text" name="titleEdit"  v-model="docEdit.title" class="form-control" id="titleEdit" placeholder="Lord of the rings" required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control"  name="authorEdit"  v-model="docEdit.author"  id="authorEdit" placeholder="Edison Cordero" required>
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <select class="form-select" multiple  aria-label="tags" id="tagsEdit" name="tagsEdit" v-model="docEdit.tags" >                            
                                <option value="Information">Information</option>
                                <option value="Activities">Activities</option>
                                <option value="Report">Report</option>
                                <option value="Essay">Essay</option>
                            </select>
                        </div>         
                        <div class="mb-3">
                            <label for="content" class="form-label">MarkDown Content</label>
                            <textarea class="form-control" id="contentEdit" name="contentEdit"  v-model="docEdit.content"  rows="3" required></textarea>
                        </div>
                         <div class="mb-3">
                            <label for="content" class="form-label">Preview</label>
                            <div   v-html="compiledMarkdown"  rows="3" ></div>
                        </div>
                                    
                      
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-secondary" type="button" data-bs-dismiss="modal" >Close</button>
                    <button type=" submit" class="btn btn-primary">Save Document</button>
                </div>
                </form>    
            </div>
        </div>
    </div>
</template>
<script> 
    export default{   
        data: function(){
            return{
                docEdit: {
                    title: "",
                    author: "",
                    content: "",
                    creationDate: "",
                    tags:[]
                }

            }
        },
        methods:{
            updateDoc: function(){
                if(this.docEdit.title =="" || this.docEdit.author =="" || this.docEdit.content =="" ){
                    return ;
                }
                axios.put('api/document/'+ this.docEdit.id,{
                    doc: this.docEdit
                })
                .then( response =>{
                    if( response.status == 201 || response.status == 200 ){                      
                        this.$emit('reloadlist');
                        this.$toaster.success('Document Updated.');
                        $('#DocFormEdit').modal('hide'); 
                    }
                })
                .catch( error => {
                    console.log( error);
                } )
            }
        },
         created() {
                Event.$on('editModal', (docu) => {
                this.docEdit = docu;
                $('#DocFormEdit').modal('show')
            });
        },
        computed: {
            compiledMarkdown() {
                return marked(this.docEdit.content,{sanitize: true});
            }
        },

        
    }
</script>