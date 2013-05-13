package com.bby.main;

import com.bby.pipeline.DealFileSource;
import com.bby.rollinghash.CyclicHash;

public class Main {
   public static void main(String args[]) {
      //new DealFileSource();
      String s = "some string";
      int n = 3; //hash all sequences of 3 characters
      CyclicHash ch = new CyclicHash(n);
      int k = 0;
      for(; k<n-1;++k) {
              ch.eat(s.charAt(k));
      }
      int rollinghash = ch.eat(s.charAt(k)); // the first or last 32-(n-1) bits are
      System.out.println(k + " " + rollinghash);
      // do something with the hash value
//      for(;k<s.length();++k) {
//              rollinghash = ch.update(s.charAt(k-n), s.charAt(k));
//              // do something with the hash value
//              System.out.println(k + " " + rollinghash);
//      }

   }
}
