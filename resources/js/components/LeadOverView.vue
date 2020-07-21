<template>
  <v-row justify="center">
    <v-col cols="12" md="3" v-for="i in 3" :key="i">
      <v-card class="w-100" height="100" elevation="2">
        <v-row class="fill-height" align="center" justify="center">hello</v-row>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data: () => ({}),

  methods: {
    submit() {},
    clear() {}
  }
};
</script>