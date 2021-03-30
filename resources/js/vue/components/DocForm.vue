<template>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="DocForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form  v-on:submit.prevent="addDoc">     
                <div class="modal-body">
                             
                        <div class="mb-3">
                            <label for="Title" class="form-label">Title</label>
                            <input type="text" name="title"  v-model="doc.title" class="form-control" id="title" placeholder="Lord of the rings" required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control"  name="author"  v-model="doc.author"  id="author" placeholder="Edison Cordero" required>
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">Select Tags</label>
                            
                            <select class="form-select" multiple  aria-label="tags" id="tags" name="tags" v-model="doc.tags" >                            
                                <option value="Information">Information</option>
                                <option value="Activities">Activities</option>
                                <option value="Report">Report</option>
                                <option value="Essay">Essay</option>
                            </select>
                        </div>      
                        <div class="mb-3">
                            <label for="content" class="form-label">MarkDown Content</label>
                            <textarea class="form-control" id="content" name="content"  v-model="doc.content"  rows="3" required></textarea>
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
                doc: {
                    title: "",
                    author: "",
                    content: "",
                    tags:[],
                    creationDate: ""
                }

            }
        },
        methods:{
            addDoc: function(){
                if(this.doc.title =="" || this.doc.author =="" || this.doc.content =="" ){
                    return ;
                }
                axios.post('api/document/store',{
                    doc: this.doc
                })
                .then( response =>{
                    if( response.status == 201 ){
                        this.doc.title = "";
                        this.doc.author = "";
                        this.doc.content = "";  
                        this.doc.tags= [],                      
                        this.$emit('reloadlist');
                        this.$toaster.success('Document Saved.');
                        $('#DocForm').modal('hide'); 
                    }
                })
                .catch( error => {
                    console.log( error);
                } )
            }
        },
        computed: {
            compiledMarkdown() {
                return marked(this.doc.content,{sanitize: true});
            }
        },

       
    }
     
    
</script>