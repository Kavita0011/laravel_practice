import React, { useEffect, useState } from 'react';
import axios from 'axios';

// Create axios instance
const api = axios.create({
  baseURL: '/dashboard/members',
});

// Axios request interceptor to dynamically inject the token
api.interceptors.request.use(
  config => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  error => Promise.reject(error)
);

const Members = () => {
  const [members, setMembers] = useState([]);
  const [form, setForm] = useState({ name: '', medicaid_id: '' });
  const [editingId, setEditingId] = useState(null);
  const [loading, setLoading] = useState(false);

  const fetchMembers = async () => {
    try {
      const res = await api.get('/members');
      setMembers(res.data);
    } catch (error) {
      console.error('Error fetching members:', error);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    try {
      if (editingId) {
        await api.put(`/members/${editingId}`, form);
      } else {
        await api.post('/members', form);
      }
      setForm({ name: '', medicaid_id: '' });
      setEditingId(null);
      fetchMembers();
    } catch (error) {
      console.error('Error saving member:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleEdit = (member) => {
    setForm({ name: member.name, medicaid_id: member.medicaid_id });
    setEditingId(member.id);
  };

  const handleDelete = async (id) => {
    if (!window.confirm('Are you sure you want to delete this member?')) return;
    try {
      await api.delete(`/members/${id}`);
      fetchMembers();
    } catch (error) {
      console.error('Error deleting member:', error);
    }
  };

  useEffect(() => {
    fetchMembers();
  }, []);

  return (
    <div className="p-6 max-w-4xl mx-auto">
      <h2 className="text-2xl font-semibold text-center mb-6 text-gray-800">Member Management</h2>

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
