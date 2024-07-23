//
//  Profile.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 5/7/23.
//

import Foundation

struct Profile {
    var username: String
    var prefersNotifications: Bool = true
    var seasonalPhoto = Season.winter
    var goalDate = Date()
    
    static let `default` = Profile(username: "Huracán López Romero")
    
    
    enum Season: String, CaseIterable, Identifiable {
        case winter = "☃️"
        case summer = "🌞"
        case spring = "🌷"
        case autumn = "🍁"
        
        
        var id: String { rawValue }
    }
}
