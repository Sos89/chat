<template>
    <div class="h-96 w-max ml-auto bg-indigo-100">
        <div class="h-full p-2 flex-col-reverse scroll" >
            <div v-for="(message, index) in messages.slice().reverse()" :key="index">
                <message-item :message="message"/>
            </div>
        </div>
    </div>
</template>

<script>
import MessageItem from "./messageItem";
export default {
    name: "messageContainer",
    components: {MessageItem},
    props: ['messages'],

}
</script>

<style scoped>
.scroll{
    overflow-x: hidden;
    overflow-y: scroll;
    width: 500px;
}
</style>
