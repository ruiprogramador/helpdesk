<h1 align="center">Help Desk System</h1>

## About Help Desk System

This project is a Help Desk System built with Laravel for the back-end and in the future is to use Vue.js for the front-end, designed to help users create, track, and resolve support tickets. The integration of Vue.js introduces a more dynamic, interactive user experience, making the system more responsive and efficient.

I thought of the idea of ​​tickets as a ideal project to practice Laravel and Vue.js together.

## Purpose

- **Submit tickets**: Customers can create support tickets for various issues using a reactive interface.
- **Track tickets**: Real-time updates allow users to see changes to ticket statuses without refreshing the page.
- **Manage agents**: Admins can assign, view, and resolve tickets using a dynamic Vue.js interface.
- **User authentication**: Users can sign up, log in, and manage their profiles with seamless form handling.

## Features

- **User Authentication**: Built-in authentication with user roles (Admin, Agent, Customer).
- **Ticket Management**: Users can create, view, update, and track tickets with a reactive Vue.js interface.
- **Role-based Access Control**: Different views and actions depending on whether you're an admin, agent, or customer.
- **Real-time Ticket Updates**: Vue.js integrated with Laravel Echo allows for real-time ticket status updates, so users don't need to refresh the page.
- **Component-based Front-end**: Vue.js components for reusable, modular UI elements.
- **API-driven Architecture**: Communication between Vue.js and Laravel is handled through API calls (RESTful API).
- **Database Migration & Seeding**: The database is designed using Laravel migrations, and seeders populate the database with sample data.
- **Laravel Eloquent**: Using Eloquent ORM for querying and managing data.
- **Laravel Blade**: For rendering initial server-side views with embedded Vue.js components.
- **Email Notifications**: Automatically notify users when a ticket status changes (e.g., when it's resolved).
- **Vue Router & Vuex**: For managing navigation and application state in a smooth, seamless single-page application (SPA) experience.
