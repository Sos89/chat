<template>
    <div class="grid grid-cols-2">
        <div class="select_room">
            {{ selected.name }} Chat
            <select
                v-model="selected"
                @change="$emit('roomChanged', selected)"
                class="float-right">
                <option
                    v-for="(room, index ) in rooms"
                    :key="index"
                    :value=" room "
                    >
                    {{ room.name }}
                </option>
            </select>


        </div>
    </div>
</template>

<script>
export default {
    name: "chatRoomSelection",
    props: ['rooms', 'currentRoom'],
    data: function (){
        return{
            selected: ''
        }
    },
    created(){
        this.selected = this.currentRoom;
    }
}
</script>

<style scoped>
.select_room{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
}
</style>
