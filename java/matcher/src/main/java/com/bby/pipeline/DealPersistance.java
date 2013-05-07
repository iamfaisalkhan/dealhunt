package com.bby.pipeline;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.HashMap;

import com.bby.config.AppConfiguration;

public class DealPersistance {
   
   private Connection connect = null;
   private PreparedStatement dealInsert = null;
   private DBConnection db;
   private HashMap<String, Integer> crawlSourceIds = null;
   
   public DealPersistance() {
      init();
   }
   
   private void init() {
      AppConfiguration config = AppConfiguration.getInstance();
      crawlSourceIds = new HashMap<String, Integer>();
      
      try {
         db = new DBConnection(config.getProperty("db.driver"), 
                               config.getProperty("db.url"));
         connect = db.getConnection();
         
         Statement selectCrawlSources = connect.createStatement();
         selectCrawlSources.execute("Select * from Crawl");
         ResultSet rs = selectCrawlSources.getResultSet();
         while (rs.next()) {
            String source = rs.getString("source");
            int id = rs.getInt("id");
            crawlSourceIds.put(source, id);
         }
         
         dealInsert = connect.prepareStatement("INSERT INTO Deal(" +
         		"title, source, date_added, date_expires, price, Crawl_id) " +
         		" VALUES(?, ?, ?, ?, ?, ?)");
         
      } catch (Exception e) {
         e.printStackTrace();
      } finally {
      }
   }
   
   public void save(Deal d) {
      if (d.getTitle() == null || d.getTitle().length() == 0) return;
      
      try {
         dealInsert.setString(1, d.getTitle());
         dealInsert.setString(2, d.getDealSource());
         dealInsert.setString(3, d.getDateAdded());
         dealInsert.setString(4,  d.getDateExpires());
         dealInsert.setFloat(5, d.getPrice());
         int crawlId = 0;
         if (d.getCrawlSource() != null) {
            crawlId = crawlSourceIds.get(d.getCrawlSource());
         }
         
         dealInsert.setInt(6, crawlId);
         
         dealInsert.execute();
         
      } catch (Exception e) {
         e.printStackTrace();
      } finally {
         
      }
   }
}
