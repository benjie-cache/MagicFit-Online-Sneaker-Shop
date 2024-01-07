// src/services/api.js
import axios from 'axios';

export const fetchEntities = async () => {
  try {
    const response = await axios.get('api/entities'); // Update the URL as needed
    return response.data;
  } catch (error) {
    console.error('Error fetching entities:', error);
    throw error;
  }
};
