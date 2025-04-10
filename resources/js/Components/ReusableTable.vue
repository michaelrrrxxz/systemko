<template>
    <table :id="tableId" class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column.field">{{ column.label }}</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.id">
          <td v-for="column in columns" :key="column.field">{{ item[column.field] }}</td>
          <td>
            <inertia-link v-if="editAction" :href="`/${tableName}/${item.id}/edit`" class="btn btn-sm btn-warning">
              Edit
            </inertia-link>
            <button v-if="deleteAction" @click="handleDelete(item.id)" class="btn btn-sm btn-danger">
              Delete
            </button>
          </td>
        </tr>
        <tr v-if="items.length === 0">
          <td colspan="3" class="text-center">No {{ tableName }} found</td>
        </tr>
      </tbody>
    </table>
  </template>

  <script>
  export default {
    name: 'ReusableTable',
    props: {
      items: {
        type: Array,
        required: true,
      },
      columns: {
        type: Array,
        required: true,
      },
      tableId: {
        type: String,
        default: 'venues-table', // Default table ID if not provided
      },
      tableName: {
        type: String,
        required: true, // Name of the table (e.g., 'venues')
      },
      editAction: {
        type: Boolean,
        default: true, // Default to show Edit button
      },
      deleteAction: {
        type: Boolean,
        default: true, // Default to show Delete button
      },
      onDelete: {
        type: Function,
        required: true,
      },
    },
    methods: {
      handleDelete(id) {
        this.onDelete(id); // Calls the onDelete function passed from the parent
      },
    },
  };
  </script>

  <style scoped>
  /* Optionally add custom styles for the table here */
  </style>
