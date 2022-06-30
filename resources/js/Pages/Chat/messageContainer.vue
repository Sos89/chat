<template>
    <div class="h-96 w-2/3 ml-auto bg-indigo-100">
        <div class="h-full p-2 flex-col-reverse overflow-scroll ">
            <div v-for="(message, index) in messages" :key="index">
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

</style>
