import React, { useEffect, useState } from 'react';
import axios from 'axios';

// Create axios instance with baseURL and Authorization header
const token = localStorage.getItem("token") 
|| '13|jq8K0eYmeWhRdqpYj6Wdokwpetb2uAI1PhY9ajhj62f3e0a1';
// // Check if token is available in local storage
const api = axios.create({
  baseURL: '/api',
  headers: {
    Authorization: `Bearer ${token}`
  }
});
// // This code creates an axios instance with a base URL of '/api' and sets the Authorization header to include a token. The token is retrieved from local storage, and if it's not available, a default token is used. This instance can be used to make API requests with the specified base URL and headers.
const Members = () => {
    // // State variables to manage members, form data, editing ID, and loading state
  const [members, setMembers] = useState([]);
  const [form, setForm] = useState({ name: '', medicaid_id: '' });
  const [editingId, setEditingId] = useState(null);
  const [loading, setLoading] = useState(false);
// // Function to fetch members from the API
  const fetchMembers = async () => {
    try {
        // // Make a GET request to fetch members
      const res = await api.get('/members');
    //   // // Set the members state with the response data
      setMembers(res.data);
    } catch (error) {
      console.error('Error fetching members:', error);
    }
  };
// // Function to handle form submission for adding or updating members
  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    try {
        // // Prepare the form data
      if (editingId) {
        await api.put(`/members/${editingId}`, form);
      } else {
        await api.post('/members', form);
      }
    //   // // Reset the form and editing ID after submission
      setForm({ name: '', medicaid_id: '' });
      setEditingId(null);
      fetchMembers();
    } catch (error) {
      console.error('Error saving member:', error);
    } finally {
      setLoading(false);
    }
  };
// // Function to handle editing a member
  const handleEdit = (member) => {
    setForm({ name: member.name, medicaid_id: member.medicaid_id });
    setEditingId(member.id);
  };
// // Function to handle deleting a member
  // // Confirm deletion and make a DELETE request
  const handleDelete = async (id) => {
    if (!window.confirm('Are you sure you want to delete this member?')) return;
    try {
      await api.delete(`/members/${id}`);
      fetchMembers();
    } catch (error) {
      console.error('Error deleting member:', error);
    }
  };
// // Fetch members when the component mounts
  // // useEffect hook to fetch members when the component mounts
  useEffect(() => {
    fetchMembers();
  }, []);

  return (
    // // Render the member management UI
    // // The component includes a form for adding or editing members, and a table to display the list of members. It also handles loading states and confirmation dialogs for deletion.
    <div className="p-6 max-w-4xl mx-auto">
      <h2 className="text-2xl font-semibold text-center mb-6 text-gray-800">Member Management</h2>
{/* form */}
      <form onSubmit={handleSubmit} className="bg-white shadow p-4 rounded-md mb-6 space-y-4">
        <input
          type="text"
          placeholder="Name"
          value={form.name}
          onChange={e => setForm({ ...form, name: e.target.value })}
          className="border border-gray-300 rounded-md p-2 w-full"
        />
        <input
          type="text"
          placeholder="Medicaid ID"
          value={form.medicaid_id}
          onChange={e => setForm({ ...form, medicaid_id: e.target.value })}
          className="border border-gray-300 rounded-md p-2 w-full"
        />
        <button
          type="submit"
          disabled={loading}
          className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md w-full transition"
        >
          {loading ? 'Saving...' : editingId ? 'Update Member' : 'Add Member'}
        </button>
      </form>
{/* table   */}
      <div className="bg-white shadow rounded-md overflow-x-auto">
        <table className="min-w-full text-left">
          <thead className="bg-blue-600 text-white">
            <tr>
              <th className="py-3 px-4">#</th>
              <th className="py-3 px-4">Name</th>
              <th className="py-3 px-4">Medicaid ID</th>
              <th className="py-3 px-4">Actions</th>
            </tr>
          </thead>
          <tbody>
            {members.length === 0 ? (
              <tr>
                <td colSpan="4" className="text-center py-4 text-gray-500">
                  No members found.
                </td>
              </tr>
            ) : (
              members.map((member, index) => (
                <tr key={member.id} className="border-b hover:bg-gray-50">
                  <td className="py-2 px-4">{index + 1}</td>
                  <td className="py-2 px-4">{member.name}</td>
                  <td className="py-2 px-4">{member.medicaid_id}</td>
                  <td className="py-2 px-4 space-x-2">
                    <button
                      onClick={() => handleEdit(member)}
                      className="text-yellow-500 hover:underline"
                    >
                      Edit
                    </button>
                    <button
                      onClick={() => handleDelete(member.id)}
                      className="text-red-600 hover:underline"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              ))
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default Members;
// This code defines a React component for managing members. It includes functionality to fetch, add, edit, and delete members from a list. The component uses Axios for API requests and manages state with React's useState and useEffect hooks. The UI is styled using Tailwind CSS classes.
// The component includes a form for adding or editing members, and a table to display the list of members. It also handles loading states and confirmation dialogs for deletion. The API requests are made using an Axios instance with a base URL and authorization header.