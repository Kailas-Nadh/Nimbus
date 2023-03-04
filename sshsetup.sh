#! /bin/bash

sudo apt install openssh-server 
sudo apt install openssh-client
sudo apt install ufw
sudo systemctl start ssh.service
sudo systemctl enable ssh
sudo systemctl status ssh
sudo ufw allow ssh
sudo ufw enable && sudo ufw reload
sudo systemctl restart ssh.service
ssh localhost
exit

# To connect to a remote system with SSH when you only have a dynamic public IP, you can use a Dynamic DNS (DDNS) service to associate a hostname with your dynamic IP #address. Here are the steps to connect to a remote system with SSH when you have a dynamic public IP:

#Set up a Dynamic DNS (DDNS) service: A DDNS service will associate a hostname with your dynamic IP address so that you can connect to your remote system even when your IP address changes.

# Configure your router to update your DDNS service with your current IP address: Most routers have the option to automatically update your DDNS service with your current IP address.

#Set up port forwarding on your router: Port forwarding is a way to forward incoming traffic from the internet to a specific device on your local network. To set up port forwarding for SSH, you need to forward incoming traffic on port 22 to the IP address of the device running the SSH server.

#Connect to the remote system using the hostname associated with your dynamic IP address: Once you have set up port forwarding and a DDNS service, you can connect to the remote system using the hostname associated with your dynamic IP address. The command to connect to a remote system with SSH is:
