<template>
     <table class="table table-hover table-striped table-success ">
        <thead>
                <tr >
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <doc-list-item v-for="(docu,index) in filteredRows" :filter="filter" :key="index" :index="index" :docu="docu" :docs="docs">  </doc-list-item>                                        
                               
            </tbody>
           
    </table> 
</template>
<script> 
import DocListItem from './DocListItem.vue';
    export default{
        components: {  DocListItem },  
        props:['docs','filter'],  
        methods: {
           
        },      
        computed: {
            filteredRows() {
                return this.docs.filter(row => {
                        const authors = row.author.toString().toLowerCase();
                        const titles = row.title.toString().toLowerCase();
                        const tags = row.tags.toString().toLowerCase();
                        const date = row.created_at;
                        const searchTerm = this.filter.toLowerCase();

                        return authors.includes(searchTerm) ||
                               titles.includes(searchTerm) ||  
                             tags.includes(searchTerm) || 
                             date.includes(searchTerm);
                    });
            }
        }      
    }
    
</script>