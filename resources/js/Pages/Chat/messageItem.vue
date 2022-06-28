<template>
    <div>
        <img class="h-10 w-10 rounded-full object-cover" :src="message.user.profile_photo_url" :alt="message.user.name">
        {{message.user.name}} {{ message.user.surname}} : {{ message.message }}

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
</style>
