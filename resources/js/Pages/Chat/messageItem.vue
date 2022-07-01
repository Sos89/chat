<template>
    <div class="for_users">
        <div class="for_name_surname">
            <img class="h-10 w-10 rounded-full object-cover" :src="message.user.profile_photo_url" :alt="message.user.name">
            {{ message.user.name}} {{ message.user.surname }}
        </div>
        <div class="message">
            {{ message.message }}
        </div>
<!--        <div class="ml-auto">-->
<!--            {{ message.created_at }}-->
<!--        </div>-->
    </div>

</template>

<script>
export default {
    name: "messageItem",
    props: ['message'],

}
</script>

<style scoped>
img{
    display: inline;
}
.for_name_surname{
    display: flex;
    align-items: center;
    justify-content: center;
}
.for_users{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    width: 100%;
    margin: 10px;
}
.message{
    background: #b7b3b3;
    margin-left: 10px;
    margin-top: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
    padding: 5px 20px;
}
</style>
