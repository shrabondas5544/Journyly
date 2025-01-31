# Journyly - A Travel and Tour Management System (TTMS) 🚀  
![GitHub license](https://img.shields.io/github/license/shrabondas5544/Journyly?tab=MIT-1-ov-file#readme?style=flat-square)  
[![GitHub stars](https://img.shields.io/github/stars/shrabondas5544/Journyly?style=social)](https://github.com/shrabondas5544/Journyly/stargazers)  

**TTMS** is a web-based platform designed to simplify travel planning, booking, and management. It integrates hotel, flight, bus, and train bookings, tour guide scheduling, and itinerary generation into a single system. Built with Laravel, MySQL, and Tailwind CSS.

---

## 📝 Table of Contents  
- [Features](#features)  
- [Installation](#installation)  
- [Tech Stack](#tech-stack)  
- [Testing](#testing)  
- [Screenshots](#screenshots)  
- [Future Work](#future-work)  
- [License](#license)  
- [Acknowledgements](#acknowledgements)  
- [Contact](#contact)  

---

## ✨ Key Features  
### **User Features**  
- **Destination Exploration**: Search destinations by location  
- **Multi-Service Booking**: Hotels, flights, buses, and trains  
- **Tour Guide Scheduling**: Book guides based on availability and ratings  
- **Personalized Itineraries**: Generate custom travel plans  
- **Invoice Printing**: Download/print booking confirmations  
- **Notifications**: Real-time updates for bookings and offers  

### **Admin Features**  
- **Manage Transport & Hotels**: Add/update flights, buses, trains, and hotels  
- **Booking Analytics**: View booking history and trends  
- **Notifications**: Send alerts to users  
- **Dashboard**: Monitor system activity and user feedback  

---

## 🛠️ Installation  
1. **Clone the repository**:  
   bash  
   git clone https://github.com/shrabondas5544/Journyly.git
2. Set up environment:

        Rename .env.example to .env and configure database settings
  Install dependencies:
    bash
    Copy

    composer install  
    npm install  
    npm install -D tailwindcss postcss autoprefixer  
    npx tailwindcss init -p  

    Database setup:

        Create MySQL database named Journyly

        Migrate and seed:
        bash
        Copy

        php artisan migrate  
        php artisan key:generate  

    Run the app:
    bash
    Copy

    php artisan serve  
    npm run dev  

    Access at http://localhost:8000
