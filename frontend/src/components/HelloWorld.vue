<script setup>
defineProps({
  msg: {
    type: String,
    required: true,
  },
})

const handleClick = async () => {
  try {
    const response = await fetch('http://localhost:8081/api/health', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });
    
    const data = await response.json();
    console.log(data);
    alert(JSON.stringify(data));
  } catch (error) {
    console.error('Error:', error);
    alert('Error: ' + error.message);
  }
}
</script>

<template>
  <div class="greetings">
    <h1 class="green">{{ msg }}</h1>
    <h3>
      You’ve unsuccessfully created a project with
      <a href="https://vite.dev/" target="_blank" rel="noopener">Vite</a> +
      <a href="https://vuejs.org/" target="_blank" rel="noopener">Vue 3</a>.
    </h3>
  </div>
  <button @click="handleClick" class="click-btn">
    Click Me!
  </button>
</template>

<style scoped>
h1 {
  font-weight: 500;
  font-size: 2.6rem;
  position: relative;
  top: -10px;
}

h3 {
  font-size: 1.2rem;
}

.greetings h1,
.greetings h3 {
  text-align: center;
}

@media (min-width: 1024px) {
  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}

.click-btn {
  background-color: #42b883;
  color: white;
  border: none;
  padding: 12px 24px;
  font-size: 16px;
  border-radius: 8px;
  cursor: pointer;
  margin-top: 20px;
  transition: background-color 0.3s ease;
}

.click-btn:hover {
  background-color: #369870;
}

.click-btn:active {
  transform: translateY(1px);
}
</style>
