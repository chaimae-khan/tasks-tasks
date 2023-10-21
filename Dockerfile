# Use the official Ubuntu image as the base image
FROM ubuntu:latest

# Set the DEBIAN_FRONTEND variable to noninteractive
ARG DEBIAN_FRONTEND=noninteractive

# Update the package list and install nginx and curl
RUN apt-get update && apt-get install -y nginx curl

# Copy your HTML file to the default Nginx web server path
COPY index.html /var/www/html/index.html

# Set the working directory
WORKDIR /var/www/html

# Expose port 80 for Nginx
EXPOSE 80

# Start Nginx in the foreground as the entry point
CMD ["/usr/sbin/nginx", "-g", "daemon off;"]

