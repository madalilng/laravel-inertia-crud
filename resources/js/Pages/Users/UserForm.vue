<template>
  <div
    class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
    style="height: 405px;"
  >
    <div class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
      <div class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">
        User Form
      </div>

      <div class="flex flex-col space-y-1 p-2">
        <input
          class="form-input rounded-md shadow-sm h-8"
          placeholder="Name"
          v-model="userForm.name"
        >

        <input
          class="form-input rounded-md shadow-sm h-8"
          placeholder="Email"
          v-model="userForm.email"
        >

        <input
          type="password"
          class="form-input rounded-md shadow-sm h-8"
          placeholder="Password"
          v-model="userForm.password"
        >

        <div class="flex flex-row justify-center pt-3">
          <div class="">
            <div v-if="selectedUser">
              <div class="py-1 px-4 inline-flex rounded-md bg-white shadow">
                <a
                  @click="deleteUser"
                  class="text-gray-700 font-semibold select-none cursor-pointer"
                >
                  Delete
                </a>
              </div>

              <div class="py-1 px-4 inline-flex rounded-md bg-white shadow">
                <a
                  @click="updateUser"
                  class="text-gray-700 font-semibold select-none cursor-pointer"
                >
                  Update
                </a>
              </div>

            </div>

            <div
              v-else
              class="py-1 px-4 inline-flex rounded-md bg-white shadow"
            >
              <a
                @click="registerUser"
                class="text-gray-700 font-semibold select-none cursor-pointer"
              >
                Register
              </a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
  props: ["selectedUser"],
  data() {
    return {
      userForm: {
        email: "",
        name: "",
        password: ""
      }
    };
  },

  created() {
    if (this.selectedUser) this.userForm = { ...this.selectedUser };
  },

  watch: {
    selectedUser: {
      deep: true,
      handler(newValue) {
        if (newValue) this.userForm = { ...newValue };
      }
    }
  },

  methods: {
    registerUser() {
      Inertia.post("/user/register", this.userForm);
    },

    deleteUser() {
      Inertia.delete(`/user/${this.userForm.id}`, {
        onSuccess: response => {
          this.userForm = {
            name: undefined,
            password: undefined,
            email: undefined
          };
        }
      });
    },

    updateUser() {
      Inertia.patch(`/user/${this.userForm.id}`, this.userForm);
    }
  }
};
</script>

<style>
</style>