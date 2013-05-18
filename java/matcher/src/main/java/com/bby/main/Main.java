package com.bby.main;

import java.io.IOException;
import java.io.Reader;
import java.io.StringReader;

import org.apache.lucene.analysis.TokenStream;
import org.apache.lucene.analysis.ngram.NGramTokenizer;
import org.apache.lucene.analysis.shingle.ShingleFilter;
import org.apache.lucene.analysis.standard.StandardTokenizer;
import org.apache.lucene.analysis.tokenattributes.CharTermAttribute;
import org.apache.lucene.util.Version;

import com.bby.pipeline.DealFileSource;
import com.bby.rollinghash.CyclicHash;
import com.bby.rollinghash.RabinKarpHash;

public class Main {
   
   private static int n = 9;
   
   public static void chash2(String[] s) {
      CyclicHash ch = new CyclicHash(n);
      
      int k = 0;
      int rollinghash = 0;
      int subIndex = 0;
      
      for (int i = 0; i < s.length; i++) {
         // eat initial few characters. 
         for(; k < n; ++k) {
            rollinghash = ch.eat(s[i].charAt(k));
         }

         for (; k < s[i].length(); ++k) {
            int endIndex = Math.min(subIndex+n, s[i].length()-1);
            System.out.println(s[i].substring(subIndex, endIndex) + " " + rollinghash + " ");
            ++subIndex;
            rollinghash = ch.update(s[i].charAt(k-n), s[i].charAt(k));
         }
         int endIndex = Math.min(subIndex+n, s[i].length()-1);
         System.out.println(s[i].substring(subIndex, endIndex) + " " + rollinghash + " ");
         
         k = 0;
         ch.reset();
         subIndex = 0;

      }
   }
   
   public static void chash(String[] s) {
      CyclicHash ch = new CyclicHash(n);
      
      // initialization
      int k = 0;
      int rollinghash = 0;
      int subIndex = 0;
      for(; k<n;++k) {
         rollinghash = ch.eat(s[0].charAt(k));
      }
      
            
      for (int i = 0; i < s.length; i++) {
         for (; k < s[i].length(); ++k) {
            System.out.println(s[i].substring(subIndex, subIndex+n) + " " + rollinghash + " ");
            ++subIndex;
            rollinghash = ch.update(s[i].charAt(k-n), s[i].charAt(k));
         }
         System.out.println(s[i].substring(subIndex, subIndex+n) + " " + rollinghash + " ");

         if ( (i+1) < s.length) {
            k = 0;
            for (; k < n; ++k) {
               rollinghash = ch.update(s[i].charAt(s[i].length() - (n - k)), s[i+1].charAt(k));
            }
            subIndex = 0;
         }
      }
      
   }
  
   public static void chash(String s) {
      RabinKarpHash ch = new RabinKarpHash(n);
      int k = 0;
      for(; k<n-1;++k) {
              ch.eat(s.charAt(k));
      }
      
      int rollinghash = ch.eat(s.charAt(k));
      int subIndex = 0;
      System.out.println(s.substring(subIndex, subIndex+n) + " " + rollinghash + " ");
      ++k;
      // do something with the hash value
      
      for(;k<s.length();++k) {
         ++subIndex;
//         System.out.println((k-n) + " " + k);
         rollinghash = ch.update(s.charAt(k-n), s.charAt(k));
         System.out.println(s.substring(subIndex, subIndex+n) + " " + rollinghash + " ");
      }
      
      System.out.println();
   }
   
   public static void main(String args[]) {
      //new DealFileSource();
      //String s1 = "Logitech M600 910-002666 USB RF Wireless Optical";
      //String s2 = "Logitech M600 910-002666 Temp Stage USB RF Wireless Optical";
      String s1 = "Thre are monkeys in the farm".replaceAll("\\s", "");
      String s2 ="abcdefghi";
      String s3 = "Thre are monkeys in the farm".replaceAll("\\s", "");
      
      String data[] = {s1, s2, s3};
      Main.chash2(data);
      
      //Main.chash(s1);
      //Main.chash(s2);
      

//      s.replaceAll("\\s", "");
//      System.out.println(s);
//      
//      Reader reader = new StringReader(s);
//      //NGramTokenizer gtokneizer = new NGramTokenizer(reader, 1, 3);
//      TokenStream tokenizer = new StandardTokenizer(Version.LUCENE_36, reader);
//      tokenizer = new ShingleFilter(tokenizer, 2, 9);
//      CharTermAttribute attr = tokenizer.addAttribute(CharTermAttribute.class);
//      int index = 0;
//      
//      try {
//         while (tokenizer.incrementToken()) {
//            System.out.println(++index + " " + attr.toString());
//         }
//      } catch (IOException e) {
//         // TODO Auto-generated catch block
//         e.printStackTrace();
//      }
      
   }
}
