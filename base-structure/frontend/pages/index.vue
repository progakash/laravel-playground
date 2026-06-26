<script setup lang="ts">
interface User {
  id: number
  name: string
  email: string
  role: string
}

const { data, status, error } = await useFetch<{ data: User[] }>('/api/users')

const users = computed(() => data.value?.data ?? [])
</script>

<template>
  <div style="max-width: 800px; margin: 40px auto; font-family: sans-serif; padding: 0 16px;">
    <h1 style="margin-bottom: 24px;">User List</h1>

    <p v-if="status === 'pending'" style="color: #6b7280;">Loading...</p>

    <p v-else-if="error" style="color: #dc2626;">
      Failed to load users: {{ error.message }}
    </p>

    <template v-else>
      <table style="width: 100%; border-collapse: collapse;">
        <thead>
          <tr style="background: #f3f4f6;">
            <th style="padding: 12px 16px; text-align: left; border-bottom: 2px solid #e5e7eb;">#</th>
            <th style="padding: 12px 16px; text-align: left; border-bottom: 2px solid #e5e7eb;">Name</th>
            <th style="padding: 12px 16px; text-align: left; border-bottom: 2px solid #e5e7eb;">Email</th>
            <th style="padding: 12px 16px; text-align: left; border-bottom: 2px solid #e5e7eb;">Role</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="user in users"
            :key="user.id"
            style="border-bottom: 1px solid #e5e7eb;"
          >
            <td style="padding: 12px 16px; color: #6b7280;">{{ user.id }}</td>
            <td style="padding: 12px 16px; font-weight: 500;">{{ user.name }}</td>
            <td style="padding: 12px 16px; color: #374151;">{{ user.email }}</td>
            <td style="padding: 12px 16px;">
              <span :style="{
                padding: '2px 10px',
                borderRadius: '12px',
                fontSize: '12px',
                fontWeight: '600',
                background: user.role === 'Admin' ? '#dbeafe' : user.role === 'Editor' ? '#dcfce7' : '#f3f4f6',
                color: user.role === 'Admin' ? '#1d4ed8' : user.role === 'Editor' ? '#15803d' : '#374151',
              }">
                {{ user.role }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>

      <p style="margin-top: 16px; color: #6b7280; font-size: 14px;">
        Total: {{ users.length }} users
      </p>
    </template>
  </div>
</template>
