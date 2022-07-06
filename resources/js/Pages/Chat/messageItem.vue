<template>

<div v-if="message.user.id == 1">
    <div class="for_users">
        <div class="for_name_surname">
            <img class="h-10 w-10 rounded-full object-cover" :src="message.user.profile_photo_url" :alt="message.user.name">
            {{ message.user.name}} {{ message.user.surname }}
        </div>
        <div class="message bg-gray-900">
            {{ message.message }}
        </div>
    </div>
</div>
<div v-else>
    <div class="for_users2">
        <div class="for_name_surname2">
            {{ message.user.name}} {{ message.user.surname }}
            <img class="h-10 w-10 mx-1 rounded-full object-cover" :src="message.user.profile_photo_url" :alt="message.user.name">
        </div>
        <div class="message2 bg-gray-900">
            {{ message.message }}
        </div>
    </div>
</div>
</template>

<script>

export default {
    name: "messageItem",
    props: ['message', 'users'],

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
.for_name_surname2{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 5px;
}
.for_users{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    width: 100%;
    margin: 10px;
}
.for_users2{
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-end;
    width: 100%;
    margin: 10px;
}
.message{
    background: #bacab9;
    margin-right: 10px;
    margin-top: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
    padding: 5px 20px;
}
.message2{
    background: rgba(42, 55, 105, 0.95);
    margin-right: 10px;
    margin-top: 10px;
    border-top-left-radius: 10px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
    padding: 5px 20px;
}
</style>
