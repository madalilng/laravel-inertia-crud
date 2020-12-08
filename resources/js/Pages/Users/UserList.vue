<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Users
      </h2>
    </template>

    <div class="py-12">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          v-if="error"
          class="bg-red-100 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center "
        >
          {{ error }}
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-row space-x-none">

          <div class="flex-none w-3/12 py-6 px-3">
            <UserForm :selectedUser="selectedUser" />
          </div>

          <custom-table
            class="flex-grow"
            :columns="columns"
            :data="users"
            @select-row="selectRow"
            :selected-row="selectedUser"
          />
        </div>
      </div>

    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CustomTable from "@/Components/CustomTable";
import UserForm from "./UserForm";

export default {
  props: ["users", "selectedUser", "errors"],
  components: {
    AppLayout,
    CustomTable,
    UserForm
  },

  data() {
    return {
      columns: [
        {
          name: "name",
          label: "Name",
          field: "name"
        },
        {
          name: "email",
          label: "Email",
          field: "email"
        }
      ]
    };
  },

  computed: {
    error() {
      if (this.errors[Object.keys(this.errors)[0]])
        return this.errors[Object.keys(this.errors)[0]][0];
      return null;
    }
  },

  methods: {
    selectRow(user) {
      this.$inertia.replace(this.route("user.view", user.id));
    }
  }
};
</script>

<style>
</style>