<template lang="pug">
  div.thread-form-dialog
    v-dialog(v-model="show" persistent max-width="600px")
      v-card
        v-card-title
          span.headline User Profile
        v-card-text
          thread-form(@success="$emit('close')")
        v-card-actions
          v-spacer
          v-btn(color="blue darken-1" flat @click="$emit('close')") 閉じる
</template>

<script>
import ThreadForm from './ThreadForm.vue';
export default {
  name: 'thread-form-dialog',
  components: {
    ThreadForm
  },
  props: {
    show: {
      type: Boolean,
      required: true
    }
  }
}
</script>
