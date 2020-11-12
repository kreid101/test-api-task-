<template>
  <div id="app">
    <b-button variant="success" @click="prodshow=!prodshow" class="add-btn mb-2 mt-2">Добавить товар</b-button>
    <div class="add-prod" v-if="prodshow==true">
      <b-form @submit.prevent="addproduct">
        <b-form-input type="text" v-model="name" placeholder="name"  class="mb-2 mr-sm-2 mb-sm-0" required></b-form-input>
        <b-form-input class="mt-2" type="text" v-model="price" placeholder="price" required></b-form-input>
        <b-button class="mt-2 ml-4 mb-2" variant="success" type="submit">Добавить</b-button>
      </b-form>
    </div>
<div class="products">
  <div v-for="prod in product" :key="prod.id">
    <b-card
      :title=prod.name
      img-alt="Image"
      img-top
      tag="article"
      style="max-width: 20rem;"
      class="mb-2"
    >
      <b-card-text>
        price: {{prod.price}}
      </b-card-text>

      <b-button href="#" variant="primary">Go somewhere</b-button>
    </b-card>
  </div>

</div>

  </div>
</template>

<script>
import axios from 'axios'
const config = {
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded'
  }
}

export default {
  name: 'App',
  data () {
    return {
      product: [],
      name: '',
      price: '',
      prodshow: false
    }
  },
  mounted () {
    this.getproduct()
  },
  methods: {
    addproduct: function () {
      const bodyFormData = new FormData()
      bodyFormData.append('name', this.name)
      bodyFormData.append('price', this.price)
      axios.post('http://api-test-project.loc/contact-form', bodyFormData, config).then(this.getproduct(), this.name = '', this.price = '')
    },
    getproduct: function () {
      axios.get('http://api-test-project.loc').then(res => { this.product = res.data })
    }
  }
}

</script>

<style>
#app{
  display: grid;
}
.products{
  display: grid;
  grid-template-columns: auto auto auto;
  margin-left: 20px;
}
.add-prod{
  display: grid;
  justify-content: center;
}
.add-btn{
  justify-self: center;
}
</style>
