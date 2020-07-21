<template>
  <v-row justify="center">
    <v-col cols="12" md="9">
      <v-card class="mx-auto p-3">
        <form action>
          <v-text-field label="Name of the leads" v-model="name" required>
            <v-icon slot="prepend">article</v-icon>
          </v-text-field>
          <v-file-input v-model="file" label="CSV File" @change="handleFileUpload()"></v-file-input>
          <v-progress-linear
            v-if="isLoading"
            color="primary accent-4"
            indeterminate
            rounded
            height="30"
          >
          Saving leads data......
          </v-progress-linear>
          <v-row justify="end" class="pr-4 pt-2">
            <v-btn depressed class color="primary" @click="submitFile()">Submit</v-btn>
          </v-row>
        </form>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data: () => ({
    name: null,
    file: null,
    isLoading: false
  }),

  methods: {
    submitFile() {
      let vm = this;
      vm.isLoading = true;
      let formData = new FormData();
      formData.append("file", this.file);
      formData.append("name", this.name);
      axios
        .post("/api/sheet", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(function(res) {
          if (res.data.status == "success") {
            vm.isLoading = false;
            vm.name = null;
            vm.file = null;
          }
          console.log("SUCCESS!!");
        })
        .catch(function() {
          console.log("FAILURE!!");
        });
    },

    handleFileUpload() {
      console.log(this.file);
      //this.file = this.$refs.file.file[0];
    },

    clear() {
      this.name = null;
      this.file = null;
    }
  }
};
</script>