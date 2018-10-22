<template>
    <div class="home">
        <h1>{{title}}</h1>
        <p>{{user}}</p>
        <div class="links">
                    <span class="subtitle">Name : {{author.name}}</span><br/>
                    <span class="subtitle">Role : {{author.role}}</span><br/>
                    <span class="subtitle">Code : {{author.code}}</span><br/>
                   
        </div>
    </div>
</template>
<script>
    export default {
            props : ['user','author'],
            data(){
                return{
                    title:"Home component vue"
                 }
            }
        }

</script>