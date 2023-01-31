<script>

import axios from 'axios';

export default {
    name:'App',
    data(){
        return {
            baseUrl: 'http://127.0.0.1:8000/api/',
            projects : []
        }
    },
    methods:{
        getApi(){
            axios.get(this.baseUrl + 'projects')
            .then(result => {
                this.projects = result.data.projects;
                console.log(this.projects);
            })
        }
    },
    mounted(){
        this.getApi();
    }
}
</script>

<template>

    <div class="container">
        <h1>Bentornato Vue</h1>

        <div v-for="project in  projects" :key="project.id" class="post-box">
            <h3>{{project.name}}</h3>
            <p>{{ project.summary }}}</p>
        </div>
    </div>

</template>



<style>

</style>
