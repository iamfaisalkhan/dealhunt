package com.bby.pipeline;

public class Deal {
   
   private String title = "";
   private String dealSource = "";
   private String description = "";
   private String dateAdded = "";
   private String dateExpires = "";
   private String crawlSource = "";
   private boolean isActive = false;
   private float price = 0.0f;
         
   public Deal() {
   }
   
   public String getTitle() {
      return title;
   }

   public void setTitle(String title) {
      this.title = title;
   }

   public String getDealSource() {
      return dealSource;
   }

   public void setDealSource(String dealSource) {
      this.dealSource = dealSource;
   }

   public String getDescription() {
      return description;
   }

   public void setDescription(String description) {
      this.description = description;
   }

   
   public String getDateAdded() {
      return dateAdded;
   }

   public void setDateAdded(String dateAdded) {
      this.dateAdded = dateAdded;
   }

   public String getDateExpires() {
      return dateExpires;
   }

   public void setDateExpires(String dateExpires) {
      this.dateExpires = dateExpires;
   }

   public boolean isActive() {
      return isActive;
   }

   public void setActive(boolean isActive) {
      this.isActive = isActive;
   }

   public float getPrice() {
      return price;
   }

   public void setPrice(float price) {
      this.price = price;
   }

   public String getCrawlSource() {
      return crawlSource;
   }

   public void setCrawlSource(String crawlSource) {
      this.crawlSource = crawlSource;
   }
   
   
   
}
