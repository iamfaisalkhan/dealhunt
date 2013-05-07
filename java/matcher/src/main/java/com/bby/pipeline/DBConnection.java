package com.bby.pipeline;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DBConnection {
   
   private Connection connect = null;
   
   public DBConnection(String driver, String url) throws ClassNotFoundException, 
      SQLException {
      Class.forName(driver);
      connect = DriverManager.getConnection(url);
   }
   
   public Connection getConnection() {
      return connect;
   }
   
}
