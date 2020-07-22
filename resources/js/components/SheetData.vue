<template>
  <v-row justify="center">
    <v-col cols="12" md="9">
      <v-card class="mx-auto p-3">
        <v-card class="mx-auto p-3" v-if="isLoading">
          <v-progress-linear
            color="primary accent-4"
            indeterminate
            rounded
            height="30"
          >Getting data......</v-progress-linear>
        </v-card>
        <v-simple-table dense>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-center">Sl.</th>
                <th class="text-left">Name</th>
                <th class="text-left">CSV File URL</th>
                <th class="text-center">Created At</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item,i) in sheets" :key="item.id">
                <td>{{ ++i }}</td>
                <td class="text-left">{{ item.name }}</td>
                <td class="text-left">{{ item.file }}</td>
                <td>{{ item.created_at }}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
        <!-- paginate -->
        <div class="text-center" v-if="total > perPage">
          <v-container>
            <v-row justify="center">
              <v-col cols="8">
                <v-container class="max-width">
                  <v-pagination v-model="page" class="my-4" :length="length"></v-pagination>
                </v-container>
              </v-col>
            </v-row>
          </v-container>
        </div>
        <!-- <h1 class="text-center">{{paginateData}}</h1> -->
        <!-- paginate end -->
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data: () => ({
    sheets: "",
    isLoading: false,
    page: 0,
    length: 1,
    perPage: 0,
    total: 0
  }),

  watch: {
    page: function(newPage, oldPage) {
      this.getSheets(this.page);
    }
  },

  methods: {
    getSheets(page) {
      this.isLoading = true;
      axios
        .get(`/api/sheet?${page > 0 ? "page=" + page : ""}`)
        .then(res => {
          console.log(res);
          this.sheets = res.data.data;
          this.page = res.data.current_page;
          this.length = res.data.total / res.data.per_page;
          this.total = res.data.total;
          this.perPage = res.data.per_page;

          this.isLoading = false;
        })
        .catch(err => {
          console.log(err);
        });
    }
  },

  created() {
    this.getSheets(this.page);
  }
};
</script>