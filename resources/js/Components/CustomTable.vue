<template>

  <div class="container mx-auto py-6 px-2">
    <div
      class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
      style="height: 405px;"
    >
      <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
        <thead>
          <tr class="text-left">
            <th
              v-for="column in columns"
              :key="column.name"
              class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs"
            >
              {{ column.label }}
            </th>
          </tr>
        </thead>
        <tbody>
          <template>
            <tr
              class="hover:bg-gray-50 select-none"
              :class="{ 'bg-gray-200' : ( selectedId === row.id ) }"
              @click="$emit('select-row',row)"
              v-for="(row, index) in data"
              :key="index"
            >
              <td
                v-for="(column, index) in columns"
                :key="`${index}-${column.name}`"
                class="border-solid border-t border-gray-200 userId"
                :class="{ 'border-l' : index }"
              >
                <span class="text-gray-700 px-6 py-3 flex items-center">
                  {{ row[column.field] }}
                </span>
              </td>
            </tr>

          </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: ["columns", "data", "selectedRow"],

  computed: {
    selectedId() {
      if (this.selectedRow) return this.selectedRow.id;
      return 0;
    }
  }
};
</script>

<style scoped>
</style>