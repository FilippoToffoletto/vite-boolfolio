<script>

import axios from 'axios';

import ProjectItem from '../components/ProjectItem.vue';

export default {
    name:'App',
    components:{
        ProjectItem
    },
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


    },
    mounted(){
        this.getApi();
    }
}
</script>

<template>

    <div>

        <h1>Elenco Progetti</h1>

        <ProjectItem v-for="project in  projects" :project="project" :key="project.id"/>

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



<style lang="scss" scoped>

.paginator{
    button{
        padding: 5px 10px;
        margin-right: 5px;
        color: black;
    }
}

</style>
