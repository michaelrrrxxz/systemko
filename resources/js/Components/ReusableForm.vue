<template>
    <form @submit.prevent="handleSubmit" novalidate>
      <div class="modal-body">
        <div class="form-group" v-for="(field, index) in fields" :key="index">
          <label :for="field.name">{{ field.label }}</label>

          <!-- Input type based on field type -->
          <input
            v-if="field.type === 'text' || field.type === 'email' || field.type === 'password'"
            :type="field.type"
            class="form-control"
            v-model="formData[field.name]"
            :class="{ 'is-invalid': errors[field.name] }"
            :required="field.required"
            :placeholder="field.placeholder"
          />

          <select v-if="field.type === 'select'" class="form-control" v-model="formData[field.name]" :required="field.required">
            <option v-for="(option, index) in field.options" :key="index" :value="option.value">
              {{ option.label }}
            </option>
          </select>

          <div class="invalid-feedback">{{ errors[field.name] }}</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="closeModal">
          Close
        </button>
        <button type="reset" class="btn btn-warning" @click="resetForm">
          Reset
        </button>
        <button type="submit" class="btn btn-success">
          Save
        </button>
      </div>
    </form>
  </template>

  <script>
  export default {
    props: {
      // Fields are passed dynamically from parent component
      fields: {
        type: Array,
        required: true,
      },
      // Form data, passed to bind to the fields
      formData: {
        type: Object,
        required: true,
      },
      // Errors for validation
      errors: {
        type: Object,
        required: true,
      },
      // Save method to handle form submission
      saveMethod: {
        type: Function,
        required: true,
      },
      // Close modal method
      closeModal: {
        type: Function,
        required: true,
      },
      // Reset form method
      resetForm: {
        type: Function,
        required: true,
      },
    },
    methods: {
      handleSubmit() {
        this.saveMethod(); // Call the save method passed from the parent
      },
    },
  };
  </script>

  <style scoped>
  /* You can add specific styles here if needed */
  </style>
