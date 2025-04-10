<template>
    <button
      @click="handleClick"
      :class="['btn', 'btn-sm', buttonClass]"
      :data-toggle="tooltip ? 'tooltip' : ''"
      :data-placement="tooltipPlacement"
      :title="tooltip ? tooltipText : ''">
      <i :class="iconClass"></i> {{ label }}
    </button>
  </template>

  <script>
  export default {
    name: 'CardButton',
    props: {
      label: {
        type: String,
        required: true,
        default: 'Add Item',
      },
      buttonClass: {
        type: String,
        default: 'btn-success',
      },
      iconClass: {
        type: String,
        default: 'fas fa-plus text-white',
      },
      tooltip: {
        type: Boolean,
        default: true,
      },
      tooltipText: {
        type: String,
        default: '',
      },
      tooltipPlacement: {
        type: String,
        default: 'bottom',
      },
      openModal: {
        type: Function,
        required: true,
      },
    },
    methods: {
      handleClick() {
        if (this.openModal) {
          this.openModal();
        }
      },
    },
  };
  </script>

