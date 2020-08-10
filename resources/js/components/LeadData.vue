<template>
  <v-row justify="center">
    <v-col cols="12" md="12">
      <v-card class="mx-auto p-3">
        <v-container>
          <v-row>
            <v-col cols="10" offset-md="9" md="3">
              <v-btn class="success" style="width:100%;" @click="csv()">
                <v-icon>cloud_download</v-icon>CSV Download
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="2">
              <v-text-field label="Title" clearable v-model="filter.title" required></v-text-field>
            </v-col>

            <v-col cols="12" md="3">
              <v-combobox
                v-model="filter.tags"
                :items="items"
                chips
                clearable
                label="Tags"
                multiple
                style="margin-top: 0px;padding-top: 7px;"
              >
                <template v-slot:selection="{ attrs, item, select, selected }">
                  <v-chip
                    v-bind="attrs"
                    :input-value="selected"
                    close
                    @click="select"
                    @click:close="removeTag(item)"
                  >
                    <strong>{{ item }}</strong>
                  </v-chip>
                </template>
              </v-combobox>
            </v-col>

            <v-col cols="12" md="2">
              <v-text-field label="City" clearable v-model="filter.city" required></v-text-field>
            </v-col>

            <v-col cols="12" md="2">
              <v-text-field label="State" clearable v-model="filter.state" required></v-text-field>
            </v-col>

            <v-col cols="12" md="2">
              <v-text-field label="Country" clearable v-model="filter.country" required></v-text-field>
            </v-col>

            <v-col cols="12" md="1">
              <v-btn class="success" clearable @click="search()">
                <v-icon>search</v-icon>Search
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
        <v-simple-table fixed-header height="620px" dense>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-center">Sl.</th>
                <th class="text-left">Source Link</th>
                <th class="text-left">Company Name</th>
                <th class="text-center">Contact Name</th>
                <th class="text-center">First Name</th>
                <th class="text-center">Last Name</th>
                <th class="text-center">Email Address</th>
                <th class="text-center">Title</th>
                <th class="text-center">Tag</th>
                <th class="text-center">Phone Number</th>
                <th class="text-center">Web Link</th>
                <th class="text-center">Review By</th>
                <th class="text-center">Linkedin Link</th>
                <th class="text-center">Company Linkedin</th>
                <th class="text-center">Working Duration</th>
                <th class="text-center">Location</th>
                <th class="text-center">Address</th>
                <th class="text-center">City</th>
                <th class="text-center">State</th>
                <th class="text-center">Zip Code</th>
                <th class="text-center">Country</th>
                <th class="text-center">Created At</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item,i) in leads" :key="item.id">
                <span style="display:none">{{++i}}</span>
                <td>{{ (page > 1 ? i+(page-1)*perPage : i) }}</td>
                <td class="text-left">
                  <a :href="item.source_link" target="_blank">Source Link...</a>
                </td>
                <td class="text-left">{{ item.company_name }}</td>
                <td class="text-left">{{ item.contact_name }}</td>
                <td class="text-left">{{ item.first_name }}</td>
                <td class="text-left">{{ item.last_name }}</td>
                <td class="text-left">{{ item.email_address }}</td>
                <td class="text-left">{{ item.title }}</td>
                <td class="text-left">{{ item.tag }}</td>
                <td class="text-left">{{ item.phone_number }}</td>
                <td class="text-left">{{ item.web_link }}</td>
                <td class="text-left">{{ item.review_by }}</td>
                <td class="text-left">{{ item.linkedin_link }}</td>
                <td class="text-left">{{ item.company_linkedin }}</td>
                <td class="text-left">{{ item.working_duration }}</td>
                <td class="text-left">{{ item.location }}</td>
                <td class="text-left">{{ item.address }}</td>
                <td class="text-left">{{ item.city }}</td>
                <td class="text-left">{{ item.state }}</td>
                <td class="text-left">{{ item.zip_code }}</td>
                <td class="text-left">{{ item.country }}</td>
                <td>{{ item.created_at }}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
        <!-- paginate -->
        <div class="text-center" v-if="total > perPage">
          <v-container>
            <v-row justify="center">
              <v-col cols="8" class="p-0 m-0">
                <v-container class="max-width p-0 m-0">
                  <v-pagination v-model="page" class="p-0 m-0" :length="length"></v-pagination>
                </v-container>
              </v-col>
            </v-row>
          </v-container>
        </div>
        <!-- <h1 class="text-center">{{paginateData}}</h1> -->
        <!-- paginate end -->
        <v-card class="mx-auto p-3" v-if="isLoading">
          <v-progress-linear
            color="primary accent-4"
            indeterminate
            rounded
            height="15"
          >Getting data......</v-progress-linear>
        </v-card>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data: () => ({
    leads: "",
    isLoading: false,
    page: 0,
    length: 1,
    perPage: 0,
    total: 0,
    filter: {
      tags: "",
      items: "",
      title: "",
      city: "",
      state: "",
      country: "",
    },
  }),

  watch: {
    page: function (newPage, oldPage) {
      this.getLeads(this.page);
    },
  },

  methods: {
    getLeads(page) {
      this.isLoading = true;
      axios
        .get(`/api/lead?${page > 0 ? "page=" + page : ""}`)
        .then((res) => {
          console.log(res);
          this.leads = res.data.data;
          this.page = res.data.current_page;
          this.length = res.data.total / res.data.per_page;
          this.total = res.data.total;
          this.perPage = res.data.per_page;

          this.isLoading = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    removeTag(item) {
      this.filter.tags.splice(this.filter.tags.indexOf(item), 1);
      this.filter.tags = [...this.filter.tags];
    },

    search() {
      this.isLoading = true;
      axios
        .post("/api/lead/search", {
          tag: this.filter.tags,
          title: this.filter.title,
          city: this.filter.city,
          state: this.filter.state,
          country: this.filter.country,
        })
        .then((res) => {
          this.leads = res.data.data;
          this.page = res.data.current_page;
          this.length = res.data.total / res.data.per_page;
          this.total = res.data.total;
          this.perPage = res.data.per_page;

          this.isLoading = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    csv() {
      this.isLoading = true;
      axios
        .post("/api/lead/csv", {
          tag: this.filter.tags,
          title: this.filter.title,
          city: this.filter.city,
          state: this.filter.state,
          country: this.filter.country,
        })
        .then((res) => {
          console.log(res.data);

          // this.isLoading = false;
          // const url = window.URL.createObjectURL(new Blob([res.data.data]));
          // const link = document.createElement("a");
          // console.log(url);
          // link.href = url;
          // link.setAttribute("download", "file.csv");
          // document.body.appendChild(link);
          // link.click();

          window.location.href = res.data;
          this.isLoading = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {
    this.getLeads(this.page);
  },
};
</script>



