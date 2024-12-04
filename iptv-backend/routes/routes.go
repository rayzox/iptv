package routes

import (
	"iptv-backend/controllers"

	"github.com/gin-gonic/gin"
)

func SetupRouter() *gin.Engine {
	r := gin.Default()

	// Authentication routes
	r.POST("/login", controllers.Login)

	// User routes
	r.POST("/register", controllers.Register)
	r.GET("/profile", controllers.GetProfile)

	// Channel routes
	r.GET("/channels", controllers.GetChannels)
	r.POST("/channels", controllers.AddChannel)

	return r
}
