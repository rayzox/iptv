package controllers

import (
	"iptv-backend/models"
	"net/http"

	"github.com/gin-gonic/gin"
)

func GetChannels(c *gin.Context) {
	channels := []models.Channel{
		{ID: 1, Name: "Channel 1", URL: "http://example.com/1"},
		{ID: 2, Name: "Channel 2", URL: "http://example.com/2"},
	}

	c.JSON(http.StatusOK, channels)
}

func AddChannel(c *gin.Context) {
	name := c.PostForm("name")
	url := c.PostForm("url")

	if name == "" || url == "" {
		c.JSON(http.StatusBadRequest, gin.H{"message": "Name and URL are required"})
		return
	}

	channel := models.Channel{Name: name, URL: url}
	c.JSON(http.StatusCreated, gin.H{"message": "Channel added successfully", "channel": channel})
}
