<template>
<div class="h-96 w-60">
    <div v-for="(user, index) in dataUser" :key="index">
      {{ user.name}} <div class="span"></div>
    </div>
</div>

</template>

<script>
export default {
    name: "users",
    data(){
        return {
            dataUser:{},
            activeUsers: []
        }
    },

    methods: {
        getUsers(){
            axios.get('/active/users')
                .then(response => {
                    this.dataUser = response.data
                })
                .catch( error => {
                    console.log( error )
                })
        },
    },
    mounted() {
        this.getUsers();

    }
}
</script>

<style scoped>
.span{
    background-color: green;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-left: 10px;
}
</style>
