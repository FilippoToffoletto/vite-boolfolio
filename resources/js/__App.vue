<script>

import axios from 'axios';

export default {
    name:'App',
    data(){
        return {
            baseUrl: 'http://127.0.0.1:8000/api/',
            projects : [],
            contentMaxLength: 120,
            pagination:{
                current: 1,
                last: null
            }


        }
    },
    methods:{
        getApi(page){
            this.pagination.current = page;
            axios.get(this.baseUrl + 'projects', {
                params:{
                    page: this.pagination.current
                }
            })
            .then(result => {
                this.projects = result.data.projects.data;
                this.pagination.current = result.data.projects.current_page,
                this.pagination.last = result.data.projects.last_page
                console.log(this.projects);
            })
        },
        truncateText(text){
            if(text.length > this.contentMaxLength){
                return text.substr(0, this.contentMaxLength) + ' ...';
            }
            return text;
        }

    },
    mounted(){
        this.getApi();
    }
}
</script>

<template>

    <div class="container">

        <h1>Elenco Progetti</h1>

        <div v-for="project in  projects" :key="project.id" class="post-box">
            <h3>{{project.name}}</h3>
            <h4 v-if="project.category">Categoria: {{ project.category.name }}</h4>

            <p v-html="truncateText(project.summary)"></p>
        </div>

        <div class="paginator">
            <button
                :disabled="pagination.current === 1"
                @click="getApi(1)"
                > |	&lt; </button>

            <button
                :disabled="pagination.current === 1"
                @click="getApi(pagination.current - 1)"
                > &larr; </button>

            <button
                v-for="i in pagination.last" :key="i"
                :disabled="pagination.current === i"
                @click="getApi(i)"
                > {{i}} </button>

            <button
                :disabled="pagination.current === pagination.last"
                @click="getApi(pagination.current + 1)"
                > &rarr; </button>

            <button
                :disabled="pagination.current === pagination.last"
                @click="getApi(pagination.last)"
                > >| </button>
        </div>
    </div>

</template>



<style>

</style>
