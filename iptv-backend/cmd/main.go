package main

import (
	"iptv-backend/config"
	"iptv-backend/routes"
)

func main() {
	// Initialize Gin router
	router := routes.SetupRouter()

	// Load configuration
	config.LoadEnv()

	// Start server
	port := ":8080"
	router.Run(port)
}
