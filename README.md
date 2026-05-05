# [Archive] MicroNodes.tech – Cloud Infrastructure & Game Hosting (2021-2023)

> **Status:** Legacy Project / Post-Mortem  
> **Scale:** 500+ Active Customers  
> **Role:** Founder & Lead Systems Engineer

## 📌 Executive Summary
MicroNodes was a high-performance Game Service Provider (GSP) launched in 2021 to provide affordable, low-latency hosting. At its peak, the platform managed over **500 customers** across a distributed multi-cloud environment. 

This repository serves as a technical archive for the platform's frontend, custom application logic, and database schemas.

---

## 🛠 Technical Stack & Architecture

### **Infrastructure**
* **Multi-Cloud Deployment:** Managed a heterogeneous network of nodes across **Microsoft Azure, DigitalOcean, and Google Cloud Platform (GCP).**
* **Orchestration:** Deployed and maintained **Pterodactyl Panel** with multiple **Wings (nodes)** using Docker containerization.
* **Virtualization:** Leveraged KVM and Linux-based environments to optimize resource allocation for high-CPU workloads.

### **The Stack**
* **Backend/Frontend:** PHP, HTML, CSS, JavaScript.
* **Database:** MySQL
* **Security:** Implemented custom `iptables` rules and utilized edge-filtering to mitigate Layer 4 and Layer 7 DDoS attacks.

---

## 🚀 Key Engineering Challenges Overcome

### **1. Multi-Cloud Migrations**
To optimize costs and performance across resources, I executed several live migrations of the entire customer base. 
* **Solution:** Developed workflows to sync volume data and re-bind Pterodactyl Wings with minimal downtime, ensuring service continuity for hundreds of concurrent users.

### **2. DDoS Mitigation & Network Resilience**
Operating in the gaming industry meant facing constant network attacks targeting specific game ports.
* **Solution:** Gained deep experience in traffic analysis. I successfully defended against various attack vectors by configuring rate-limiting, custom firewall rules, and leveraging provider-specific edge protection.

### **3. Automated Provisioning**
Scaling to 500+ users made manual setup impossible.
* **Solution:** Utilized the Pterodactyl API to automate server creation, suspension, and resource scaling based on user billing cycles.

---

## 📈 Impact & Growth
* **User Base:** Scaled from 0 to 500+ unique user accounts.
* **Uptime:** Maintained high availability despite the complexity of managing multiple distributed providers.
* **Automation:** Reduced server deployment time from 15 minutes (manual) to under 60 seconds (automated via API).

---
*Note: This repository is for archival and portfolio purposes. Sensitive data, API keys, and private customer information have been removed to comply with security best practices.*
