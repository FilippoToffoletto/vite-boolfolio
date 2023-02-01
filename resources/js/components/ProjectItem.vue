<script>

import { truncateText } from '../data/function';

export default {
    name:'ProjectItem',
    data(){
        return{
            truncateText,
            contentMaxLength: 150
        }
    },
    props:{
        project:Object
    }
}
</script>

<template>
        <div class="post-box">
            <h3>{{project.name}}</h3>
            <h4 v-if="project.category">Categoria: {{ project.category.name }}</h4>

            <p v-html="truncateText(project.summary, contentMaxLength)"></p>
            <p class="caption">Cliente: {{ project.client_name }}</p>
        </div>
</template>



<style lang="scss" scoped>

.post-box{
    margin: 20px 0;
    border-bottom: 1px solid black;
    padding-bottom: 10px;
    h3{
        margin-bottom: 10px;
    }

}

</style>
