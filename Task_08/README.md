# Ansible Playbook: Docker & Nginx Setup

## Overview

This project automates the installation and configuration of Docker and Nginx on remote servers using Ansible. It uses a custom role (`theRole`) to handle all required tasks, variables, handlers, and defaults.

## Structure

- **hosts.ini**: Inventory file listing target servers under the `happy` group.
- **play-book.yaml**: Main playbook that applies the role to all hosts in the `happy` group.
- **theRole/**: Custom Ansible role containing:
  - `tasks/main.yml`: Steps to install Docker, Nginx, and dependencies.
  - `handlers/main.yml`: Handlers to restart Docker and Nginx services.
  - `defaults/main.yml` & `vars/main.yml`: Default and variable settings (e.g., `nginx_enabled`).
  - `meta/main.yml`: Role metadata and dependencies.
  - `README.md`: Role documentation.
  - `tests/`: Test playbook and inventory for local testing.

## Inventory ([hosts.ini](eighthTask/hosts.ini))

Defines the target servers:
```ini
[happy]
192.168.1.22 ansible_user=bbodda
192.168.1.26 ansible_user=boda_two
```

## Playbook ([play-book.yaml](eighthTask/play-book.yaml))

Runs the `theRole` role on all `happy` hosts:
```yaml
- name: Installing Nginx and docker on our servers
  hosts: happy
  become: yes
  roles:
    - theRole
```

## Role Details ([theRole/](eighthTask/theRole/))

- **Tasks**: Updates apt cache, installs dependencies, adds Docker repo & GPG key, installs Docker.
- **Handlers**: Restarts Docker and Nginx after changes.
- **Variables**: `nginx_enabled` controls Nginx installation.
- **Meta**: Role metadata and dependencies.
- **Tests**: Local test playbook and inventory.

## How to Run

1. **Install Ansible** (if not already):
   ```sh
   sudo apt update
   sudo apt install ansible
   ```

2. **Navigate to the project directory**:
   ```sh
   cd Your_Folder
   ```

3. **Run the playbook**:
   ```sh
   ansible-playbook -i hosts.ini play-book.yaml --ask-become-pass # Then Put Your Pass After Run 
   ```

## Notes

- Ensure SSH access to all hosts in `hosts.ini` with the specified users.
- The playbook uses `become: yes` for privilege escalation.
- You can customize variables in `theRole/defaults/main.yml` or `theRole/vars/main.yml`.

![Alt text]()