<script>
export default {
    name: 'Header'
}
</script>

<template>
    <header>
        <ul>
            <li><router-link :to="{ name: 'home' }">home</router-link></li>
            <li><router-link :to="{ name: 'projects' }">Progetti</router-link></li>
            <li><router-link :to="{ name: 'about' }">chi siamo</router-link></li>
            <li><router-link :to="{ name: 'contacts' }">contatti</router-link></li>
        </ul>
    </header>
</template>



<style lang="scss" scoped>

header{
    text-align: center;
    padding: 30px ;
    ul{
    list-style: none;
    li{
        display: inline-block;
        padding: 10px 20px;
        a{
            color: white;
            text-decoration: none;
            text-transform: uppercase;
            &:hover,
            .active,
            .router-link-active{
                color: yellow;
            }
        }
    }
}
}

</style>
