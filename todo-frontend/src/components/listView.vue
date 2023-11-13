<script setup>
import ListItem from "@/components/listItem.vue";
const emit = defineEmits(['reloadList', 'itemChanged'])
const { items,isEditing, } = defineProps(['items','isEditing']);

</script>


<template>
<div>
  <div v-for="(item, index) in items" :key="item.id">
    <listItem
      :item="item"
      class="item"
    @itemChanged="emit('reloadList')"/>
  </div>
</div>
</template>

<style scoped>
.item{
  background: #e6e6e6;
  padding: 5px;
  margin-top: 5px;
  border-bottom: 1px;
}
</style>