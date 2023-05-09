<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test vuetify</title>
	<link rel="stylesheet" href="{{ asset('statics/vuetify/css/materialdesignicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('statics/vuetify/css/vuetify.min.css') }}">

<style type="text/css">




</style>
	
</head>
<body>
<div id="app">
    <v-app>
      <v-main>
        <v-container>Hello world</v-container>
		
		<br>
		
		<v-row align="center" justify="space-around">
			<v-alert type="success">这里是消息</v-alert>
		</v-row>
		
		<br>
		
		<v-row align="center" justify="space-around">
			<v-btn depressed @click="m('i love you')">Normal中文</v-btn>
			<v-btn depressed color="primary">Primary</v-btn>
			<v-btn depressed color="error">Error</v-btn>
			<v-btn depressed disabled>Disabled</v-btn>
		</v-row>
		<br>
		
		<template>
		  <div>
			<v-data-table :headers="headers" :items="desserts">
			
			  <template v-slot:item.name="props">
				<v-edit-dialog :return-value.sync="props.item.name" @save="save" @cancel="cancel" @open="open" @close="close">
				  @{{ props.item.name }}
				  <template v-slot:input>
					<v-text-field v-model="props.item.name" :rules="[max25chars]" label="Edit" single-line counter></v-text-field>
				  </template>
				</v-edit-dialog>
			  </template>
			  
			  
			  <template v-slot:item.fat="props">
				<v-edit-dialog :return-value.sync="props.item.fat" @save="save" @cancel="cancel" @open="open" @close="close">
				  @{{ props.item.fat }}
				  <template v-slot:input>
					<v-text-field v-model="props.item.fat" :rules="[max25chars]" label="Edit" single-line counter></v-text-field>
				  </template>
				</v-edit-dialog>
			  </template>
			  
			  
			  
			  <template v-slot:item.iron="props">
				<v-edit-dialog :return-value.sync="props.item.iron" large persistent @save="save" @cancel="cancel" @open="open" @close="close">
				  <div>@{{ props.item.iron }}</div>
				  <template v-slot:input>
					<div class="mt-4 text-h6">
					  Update Iron
					</div>
					<v-text-field v-model="props.item.iron" :rules="[max25chars]" label="Edit" single-line counter autofocus></v-text-field>
				  </template>
				</v-edit-dialog>
			  </template>
			</v-data-table>

			<v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
			  @{{ snackText }}

			  <template v-slot:action="{ attrs }">
				<v-btn v-bind="attrs" text @click="snack = false">
				  Close
				</v-btn>
			  </template>
			</v-snackbar>
		  </div>
		</template>
		
      </v-main>
    </v-app>
  </div>
</body>
<!-- <script src="{{ asset('js/vue.min.js') }}"></script> -->
<script src="{{ asset('statics/vuetify/js/vue.min.js') }}"></script>
<script src="{{ asset('statics/vuetify/js/vuetify.min.js') }}"></script>

<script type="text/javascript">
var vm_app = new Vue({
	el: '#app',
	vuetify: new Vuetify(),
	components: {
			
	},
	data: {
		snack: false,
		snackColor: '',
		snackText: '',
		max25chars: v => v.length <= 25 || 'Input too long!',
		pagination: {},
		headers: [
			{
			text: 'Dessert (100g serving)',
			align: 'start',
			sortable: false,
			value: 'name',
			},
			{ text: 'Calories', value: 'calories' },
			{ text: 'Fat (g)脂肪', value: 'fat' },
			{ text: 'Carbs (g)', value: 'carbs' },
			{ text: 'Protein (g)', value: 'protein' },
			{ text: 'Iron (%)', value: 'iron' },
		],
		desserts: [
			{
			name: 'Frozen Yogurt',
			calories: 159,
			fat: 6.0,
			carbs: 24,
			protein: 4.0,
			iron: 1,
			},
			{
			name: 'Ice cream sandwich冰激凌',
			calories: 237,
			fat: 9.0,
			carbs: 37,
			protein: 4.3,
			iron: 1,
			},
			{
			name: 'Eclair',
			calories: 262,
			fat: 16.0,
			carbs: 23,
			protein: 6.0,
			iron: 7,
			},
			{
			name: 'Cupcake',
			calories: 305,
			fat: 3.7,
			carbs: 67,
			protein: 4.3,
			iron: 8,
			},
			{
			name: 'Gingerbread',
			calories: 356,
			fat: 16.0,
			carbs: 49,
			protein: 3.9,
			iron: 16,
			},
			{
			name: 'Jelly bean',
			calories: 375,
			fat: 0.0,
			carbs: 94,
			protein: 0.0,
			iron: 0,
			},
			{
			name: 'Lollipop',
			calories: 392,
			fat: 0.2,
			carbs: 98,
			protein: 0,
			iron: 2,
			},
			{
			name: 'Honeycomb',
			calories: 408,
			fat: 3.2,
			carbs: 87,
			protein: 6.5,
			iron: 45,
			},
			{
			name: 'Donut',
			calories: 452,
			fat: 25.0,
			carbs: 51,
			protein: 4.9,
			iron: 22,
			},
			{
			name: 'KitKat',
			calories: 518,
			fat: 26.0,
			carbs: 65,
			protein: 7,
			iron: 6,
			},
		],


	},
	methods: {
		m (value) {
			alert(value);
		 },
		 
		 
		save () {
			this.snack = true
			this.snackColor = 'success'
			this.snackText = 'Data saved'
		},
		cancel () {
			this.snack = true
			this.snackColor = 'error'
			this.snackText = 'Canceled'
		},
		open () {
			this.snack = true
			this.snackColor = 'info'
			this.snackText = 'Dialog opened'
		},
		close () {
			console.log('Dialog closed')
		},





	},
	mounted: function () {
		var _this = this;
			
		_this.m('hello');

	}
})
</script>
</html>