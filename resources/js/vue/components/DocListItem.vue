<template>   
    <tr>                
        <th scope="row">{{ index + 1 }}</th>
        <td v-html="highlightMatches(docu.title)" > </td>
        <td v-html="highlightMatches(docu.author)" > </td>
        <td>
            <ul v-for="(tag,index) in docu.tags" :key="index" style="margin:0px">
                <li v-html="highlightMatches(tag)">  </li>
            </ul>
        </td>
        <td v-html="highlightMatches(docu.created_at  )"></td>
        <td >
            <button type="button" class="btn btn-warning shadow-sm btn-sm px-3"  @click.prevent="editModal(docu)">
                <i class="fas fa-pencil-alt text-white"></i>
            </button> 
            <button type="button" class="btn btn-info shadow-sm btn-sm px-3" @click="createPDF">
                <i class="fas fa-file-pdf text-white"></i> 
            </button> 
            <button type="button" class="btn btn-danger btn-sm px-3" @click.prevent="deleteDoc()" v-on:reloadlist="getList()">
                <i class="fas fa-trash-alt "></i>
            </button>
        </td>                     
    </tr>               
          
</template>
<script> 
    import { jsPDF } from "jspdf";
    export default{
  
        props:['docu','index','docs','filter'],
        data: function(){
            return{
                content: ""
            }
        },
        methods:{
            editModal(docu){        
                  Event.$emit('editModal', docu);                                                    
            },
            deleteDoc: function(){
                if (confirm("Are you sure")) {
                    axios.delete('api/document/'+ this.docu.id,{                       
                    })
                    .then( response =>{
                        if( response.status == 201 || response.status == 200 ){  
                            this.$delete(this.docs, this.index);
                            this.$toaster.success('Document deleted.'); 
                        }
                    })
                    .catch( error => {
                        console.log( error);
                    } )
                }                
            },
            markdownContent: function(){
                 return marked(this.docu.content,{sanitize: true});
            },
             highlightMatches(text) {
                const matchExists = text.toLowerCase().includes(this.filter.toLowerCase());
                if (!matchExists) return text;

                const re = new RegExp(this.filter, 'ig');
                return text.replace(re, matchedText => `<strong>${matchedText}</strong>`);
            },
            createPDF () { 
                var doc = new jsPDF();                
               
                var htmlBody = 
                               "<div  style='font-size:6px'>Documento Markdown</div>"+
                               "<div style='font-size:6px'><b>Author: </b>" + this.docu.author  + "</div>" +
                               "<div style='font-size:6px'><b>Title: </b>" + this.docu.title  + "</div>"+ 
                               "<div style='font-size:6px'><b>Content: </b>  </div>"+
                               "<div style='font-size:6px'>" + this.markdownContent()  + " </div>" 
                doc.html(htmlBody, {
                callback: function (doc) {
                        doc.save();
                    },
                    x: 10
                });
            },
                
        },
        
           
    }
    
</script>